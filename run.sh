#!/bin/bash
chamber=sys.argv[1]
chamber1=sys.argv[2]
chamber2=sys.argv[3]
zip -r "archive-$(date +"%Y-%m-%d-%H:%M:%S").zip" $chamber $chamber1 $chamber2
#zip -r "archive-$(date +"%Y-%m-%d-%H:%M:%S").zip" 
