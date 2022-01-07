#!/bin/bash
# This script uses the GitHub Labels REST API
# //developer.github.com/v3/issues/labels/

# Provide a personal access token that can
# access the source and target repositories.
# This is how you authorize with the GitHub API.
# //help.github.com/en/articles/creating-a-personal-access-token-for-the-command-line
GH_TOKEN="51b83fe12024147aada1ca95b9fd686aba2764d4"

# If you use GitHub Enterprise, change this to "//<your_domain>/api/v3"
GH_DOMAIN="//api.github.com"

# The source repository whose labels to copy.
SRC_GH_USER="RedGuy12"
SRC_GH_REPO="perfect-pearls"

# The target repository to add or update labels.
TGT_GH_USER="RedGuy12"
read -p 'Target repository: ' TGT_GH_REPO

# ---------------------------------------------------------

# Headers used in curl commands
GH_ACCEPT_HEADER="Accept: application/vnd.github.symmetra-preview+json"
GH_AUTH_HEADER="Authorization: Bearer $GH_TOKEN"

# Bash for-loop over JSON array with jq
# //starkandwayne.com/blog/bash-for-loop-over-json-array-using-jq/
sourceLabelsJson64=$(curl --silent -H "$GH_ACCEPT_HEADER" -H "$GH_AUTH_HEADER" ${GH_DOMAIN}/repos/${SRC_GH_USER}/${SRC_GH_REPO}/labels?per_page=100 | jq '[ .[] | { "name": .name, "color": .color, "description": .description } ]' | jq -r '.[] | @base64' )

# for each label from source repo,
# invoke github api to create or update
# the label in the target repo
for sourceLabelJson64 in $sourceLabelsJson64; do

    # base64 decode the json
    sourceLabelJson=$(echo ${sourceLabelJson64} | base64 --decode | jq -r '.')

    # try to create the label
    # POST /repos/:owner/:repo/labels { name, color, description }
    # //developer.github.com/v3/issues/labels/#create-a-label
    createLabelResponse=$(echo $sourceLabelJson | curl --silent -X POST -d @- -H "$GH_ACCEPT_HEADER" -H "$GH_AUTH_HEADER" ${GH_DOMAIN}/repos/${TGT_GH_USER}/${TGT_GH_REPO}/labels)

    # if creation failed then the response doesn't include an id and jq returns 'null'
    createdLabelId=$(echo $createLabelResponse | jq -r '.id')

    # if label wasn't created maybe it's because it already exists, try to update it
    if [ "$createdLabelId" == "null" ]
    then
        updateLabelResponse=$(echo $sourceLabelJson | curl --silent -X PATCH -d @- -H "$GH_ACCEPT_HEADER" -H "$GH_AUTH_HEADER" ${GH_DOMAIN}/repos/${TGT_GH_USER}/${TGT_GH_REPO}/labels/$(echo $sourceLabelJson | jq -r '.name | @uri'))
        echo "Update label response:\n"$updateLabelResponse"\n"
    else
        echo "Create label response:\n"$createLabelResponse"\n"
    fi

done
