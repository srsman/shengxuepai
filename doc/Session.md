# Session说明文档

## 字段内容

| 字段名称 | 字段类型 | 字段说明 | 有效时间 | 首次设置位置 |
| :------ | :------ | :------ | :------ |  :------ | 
| user_id | int | 用户主键 | 默认 | UserController@login |
| username | string | 用户名 | 默认 | UserController@login |
| user_type | int | 用户类型 1:购卡用户 2:管理员 5:注册用户非会员 | 默认 | UserController@login |
| name | string | 姓名（需要激活，下同） | 默认 | UserController@login |
| sex | string | 性别| 默认 | UserController@login |
| school | string | 学校 | 默认 | UserController@login |
| year | int | 参与高考时间 | 默认 | UserController@login |
| classify | string | 文理科 | 默认 | UserController@login |

> 考虑到每个页面都要显示姓名、性别、学校、文理科，所以放入Session，不再访问数据库，以后如果把Session放入Redis中，那么这里浪费的I/O时间几乎可以忽略

