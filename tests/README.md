# 测试说明

## 测试环境配置

### 1. 创建测试配置文件

复制 `.env.example` 文件为 `.env` 并填写您的测试凭证：

```bash
cd tests
cp .env.example .env
```

然后编辑 `.env` 文件，填写您的测试信息：

```env
TEST_API_KEY=your_test_api_key_here
TEST_BASE_URL=https://open.sunbay.dev
TEST_APP_ID=your_test_app_id_here
TEST_MERCHANT_ID=your_test_merchant_id_here
TEST_TERMINAL_SN=your_test_terminal_sn_here
```

**注意：** `.env` 文件已被 `.gitignore` 忽略，不会提交到 Git 仓库。

### 2. 运行测试

#### 运行所有测试

```bash
composer test
```

或

```bash
vendor/bin/phpunit
```

#### 运行单个测试类

```bash
vendor/bin/phpunit tests/Unit/NexusClientTest.php
```

#### 运行单个测试方法（例如 testSale）

```bash
vendor/bin/phpunit tests/Unit/NexusClientTest.php::testSale
```

或使用过滤器：

```bash
vendor/bin/phpunit --filter testSale
```

### 3. 跳过集成测试

如果不想运行需要真实 API 连接的测试，测试方法中已经包含了 `markTestSkipped()`，取消注释即可跳过：

```php
$this->markTestSkipped('Requires real API connection');
```

### 4. 测试输出

测试成功时会显示：
- 交易 ID
- 响应信息

测试失败时会显示：
- 网络错误信息（SunbayNetworkException）
- API 业务错误信息（SunbayBusinessException）

## 注意事项

1. **测试环境**：确保使用测试环境的 API 密钥和 URL，不要使用生产环境
2. **测试数据**：测试中使用的金额、订单号等都是测试数据，不会产生真实交易
3. **敏感信息**：所有敏感信息都应放在 `.env` 文件中，不要提交到 Git

