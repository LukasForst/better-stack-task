#!/bin/bash
set -e

source .env
echo "${GITHUB_ACCESS_TOKEN}" | docker login ghcr.io --username LukasForst --password-stdin

docker compose pull
docker compose stop be
docker compose rm be
docker compose up -d be