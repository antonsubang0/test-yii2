1. Create Repository on GitHub
2. Clone Git command = "git clone https://github.com/antonsubang0/test-yii2.git"
3. Go to = https://www.yiiframework.com/doc/guide/2.0/en/start-installation
4. Create Project = "composer create-project --prefer-dist yiisoft/yii2-app-basic LIFETIME"
5. Move file from Lifetime Folder to root project.
6. Commit yii-fresh "git add . && git commit -m "yii-fresh"
7. Push GitHub = "git push origin main"
8. Run server = php yii serve
9. Modify \models\User.php and \controllers\SiteController to apply Admin and User
10. Commit yii-auth "git add . && git commit -m "auth simple without DB""
11. Push GitHub = "git push"
12. Create Database yii2basic and modify \config\db.php
13. Create CompaniesDB migrate file = "php yii migrate/create create_companies_table"
14. Create EmployerDB migrate file = "php yii migrate/create create_employer_table"
15. Create UsersDB migrate file = "php yii migrate/create create_users_table" (if in future I want Auth with DB).
16. Commit yii-configDB = "git add . && git commit -m "config connection DB and file migrate""
17. Push GitHub = "git push"
18. Migration = php yii migrate
19. Modify UsersDB migrate file -> add insert data
20. Commit modify = "git add . && git commit -m "modify migratefile of tabel users and insert data""
21. Push GitHub = "git push"
22. Migration = php yii migrate/fresh
23. Create branch git = "git branch company"
24. Move branch git = "git checkout company"
25. Push branch github = "git push origin company"
26. Commit modify readme on branch main = "git add . && git commit -m "modify readme" && git push origin main"
27. create file CompanyController, CompaniesModel and view company
28. Commit "git add . && git commit -m "create file CompanyController, CompaniesModel and view company""
29. create file EmployerController, EmployerModel and view employer
30. create creat, read, update and delete on employers file
31. commit crud employer = "git add . && git commit -m "crud employer""
32. Push branch github = "git push origin company"
33. fix some bug on 'create company dan role'
34. commit crud employer = "git add . && git commit -m "fix bug on create company dan role""
35. Push branch github = "git push origin company"
36. I will merge my git = "git checkout main && git merge company"
37. push main on github = "git push origin main"
