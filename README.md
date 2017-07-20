项目状态：

> 本项目由E-Kevin筹划，已有其他项目在正常运行该框架的旧版本，目前使用Yii2框架进行重构，并加入一些新的特性。


1、Wocenter 介绍
-------------

Wocenter是基于php Yii2框架开发的一款优秀的高度模块化的框架，遵循[BSD-3-Clause协议]，在此框架上可方便搭建后台管理系统，CMS系统等。

Wocenter目前提供了一套集成人事管理、安全管理、扩展中心、系统管理、运营管理等多个模块的后台管理系统，该系统默认使用AdminLTE主题，
模块功能很大程度上可以满足你的基本所需。
同时，Wocenter默认支持多语言，多主题，整套系统众多地方使用PJAX技术，页面响应速度迅速。

Wocenter 作者微信：234251232

Wocenter Github地址: https://github.com/Wonail/wocenter.git

2、Wocenter 文档
-------------

**二次开发以及安装文档：** [Wocenter 安装开发文档]【撰写中】

**使用帮助说明文档：** [Wocenter 使用帮助文档]【撰写中】


3、安装Wocenter
------------

【撰写中】

4、Wocenter 配置：
----------------

配置详细参看：【撰写中】


5、架构特色
-----------

1. Dispatch调度层，传统的MVC结构，在面对多主题个性化需求高、或新技术频出且又想要尝新但又不希望对系统原有结构和功能做太多变动等情况时显得有点力不从心，Wocenter Dispatch调度层的出现便是为了解决这一问题。
Wocenter在原有的MVC结构中加入了Dispatch调度层(简称D层)，用以进一步解藕细分C层，通过D层调度资源、显示页面、 返回相关格式结果数据给客户端，而C层则只负责路由、权限判断、提交方式合法性验证等与数据返回、页面显示无关等操作。因为很多时候，返回的数据格式、需要调度的页面数据都和不同主题有较强的相关性（区别于一般的主题样式改变，而是页面功能和架构上的改变）。
如主题A列表页面同时显示搜索表单提供数据筛查功能，而主题B的搜索表单则是通过AJAX等方式动态显示，显然B主题需要调度的页面资源变量和A主题不一样，此时如果采用同一个C层提供页面数据调度或返回相关格式结果数据的做法显然不能适用所有主题的个性化要求与设计，同时也可能给不同主题的页面提供不相关的资源数据，因此为每套主题提供专属的D层显得很有必要。并且有时面对C层复杂的动作设计，会导致C层方法量或单个动作代码过多，这与瘦控制器胖模型的设计背道而驰，而D层则可以有效地把复杂的设计解藕分离出来，针对单个动作提供专属的D层，实现一对一的关系，方便管理，同时起到瘦控制器的作用，并可使控制器与主题相关性不强，满足系统较高的可定制化需求。

2. Service服务层，Wocenter加入了Service服务层，用于处理一些与Model层数据操作关联性不高的业务逻辑，目的在于让Model层只专注于CRUD等操作，而其余的业务逻辑则交由Service层为系统或各模块提供对内开放的使用接口。

3. 升级最小化干扰，Wocenter的核心文件是以Yii2 Exception扩展方式开发，文件存放于vendor/wonail/wocenter路径下面，和第三方扩展、用户二次开发路径完全隔离，避免系统的升级导致用户二次开发的文件被覆盖。

4. 快速高效，Service层、Dispatch层等核心文件遵循Yii2的懒加载方式，系统只初始化使用到的组件服务，让您的网站快速响应。
