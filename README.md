自动化部署
https://deployer.org/

常用命令
1. 部署：dep deploy [env]
2. 迁移：
  a. 创建迁移 yii migrate/create <name> （yii migrate/create create_news_table）
  b. 执行迁移 yii migrate/ yii migrate 3 / yii migrate/to m150101_185401_create_news_table
  c. 回滚迁移 yii migrate/down / yii migrate/down 3
  d. 添加列 yii migrate/create add_position_to_post --fields="position:integer"
  e. 删除列 yii migrate/create drop_position_from_post --fields="position:integer"

chmod -R 777 path_to/backend/web/upload 
