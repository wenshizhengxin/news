SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for xyd_news_article
-- ----------------------------
DROP TABLE IF EXISTS `epii_news_article`;
CREATE TABLE `epii_news_article`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '新闻文章表主键id',
  `title` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章标题',
  `sub_title` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章副标题',
  `desc` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章简介',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '内容',
  `images` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '文章配图（多个之间用“,”隔开）',
  `author` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '作者',
  `classify_ids` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '所属新闻分类id（多个之间以“,”隔开）',
  `classify_names` varchar(512) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '所属新闻分类名称（多个之间以“,”隔开）',
  `tag_ids` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '所有标签id（多个之间以“,”隔开）',
  `tag_names` varchar(512) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '所有标签名称（多个之间以“,”号隔开）',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态：0-未发布；1-已发布',
  `top` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否置顶：0-不置顶；1-置顶',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 1000 COMMENT '排序（数字越小越靠前）',
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '浏览量',
  `x_prop1` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '扩展属性1',
  `x_prop2` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '扩展属性2',
  `x_prop3` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '扩张属性3',
  `create_time` int(10) UNSIGNED NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NULL DEFAULT 0 COMMENT '更新时间',
  `publish_time` int(10) UNSIGNED NULL DEFAULT 0 COMMENT '发表时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '新闻文章表';

-- ----------------------------
-- Table structure for xyd_news_classify
-- ----------------------------
DROP TABLE IF EXISTS `epii_news_classify`;
CREATE TABLE `epii_news_classify`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '新闻分类表主键id',
  `classify_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '分类名称',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态：0-禁用；1-启用',
  `note` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 1000 COMMENT '排序（数字越小越靠前）',
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父级分类id',
  `icon` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图标',
  `icon2` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '小图标',
  `badge` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '徽章样式',
  `badge_class` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '徽章实现类',
  `x_prop1` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '扩展属性1',
  `x_prop2` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '扩展属性2',
  `x_prop3` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '扩展属性3',
  `create_time` int(10) UNSIGNED NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '新闻分类表';

-- ----------------------------
-- Table structure for xyd_news_tag
-- ----------------------------
DROP TABLE IF EXISTS `epii_news_tag`;
CREATE TABLE `epii_news_tag`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '新闻标签表主键id',
  `tag_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '标签名称',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态：0-禁用；1-启用',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 1000 COMMENT '排序（数字越小越靠前）',
  `x_prop1` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '扩展属性1',
  `x_prop2` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '扩展属性2',
  `create_time` int(10) UNSIGNED NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '新闻标签表';

SET FOREIGN_KEY_CHECKS = 1;
