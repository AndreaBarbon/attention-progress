git add .
git commit -m "new_results"
git push
gcloud compute --project bigbrain ssh "instance-1" --zone europe-west1-b --command "cd /var/www/html && sudo git pull"