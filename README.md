1. Create Repository on GitHub
2. Clone Git command = "git clone https://github.com/antonsubang0/test-yii2.git"
3. Go to = https://www.yiiframework.com/doc/guide/2.0/en/start-installation
4. Create Project = "composer create-project --prefer-dist yiisoft/yii2-app-basic LIFETIME"
5. Move file from Lifetime Folder to root project.
6. Commit yii-fresh "git add . && git commit -m "yii-fresh"
7. Push GitHub = "git push origin main"
8. Run server = php yii serve
9. Modify \models\User.php and \controllers\SiteController to apply RBAC Admin and User
10. Commit yii-fresh "git add . && git commit -m "RBAC simple without DB"
11. Push GitHub = "git push"
12. Create Database yii2basic and modify \config\db.php
13. Create CompaniesDB migrate file = "php yii migrate/create create_companies_table"
14. Create EmployerDB migrate file = "php yii migrate/create create_employer_table"
15. Create UsersDB migrate file = "php yii migrate/create create_users_table" (if in future I want Auth with DB).
16.
