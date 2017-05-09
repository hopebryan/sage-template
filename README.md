# How to create a branch
To add changes to your GitLab project, you should create a branch. You can do it in your terminal or by using the web [interface](http://139.59.250.237/help/user/project/repository/web_editor.md#create-a-new-branch).

#### Creating a new branch using terminal
```sh
$ git clone git@139.59.250.237:webbongga/wordpress.git project-name
$ git checkout -b project-name
$ git push -u origin project-name
```


# How to push your changes to the repository
### Add changes to commit
You'll see your changes in red when you type "git status".
```sh
git add CHANGES IN RED
git commit -m "DESCRIBE THE INTENTION OF THE COMMIT"
```
### Send changes to repository
```sh
git push REMOTE NAME-OF-BRANCH
```