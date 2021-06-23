# Mitake
Laravel 三竹簡訊套件

## 安裝
安裝套件需要先安裝 Composer

#### Step 1 - 安裝套件
在專案的跟目錄下執行:

```shell
$ composer require delta935142/mitake
```

#### Step 2 - 註冊服務
開啟 `config/app.php`, 並且在 providers 陣列中加入下列:

```php
Delta935142\Mitake\Providers\MitakeServiceProvider::class,
```

#### Step 3 - 設定 .env
開啟 `.env`, 並且加入下面兩個環境變數

```env
MITAKE_USERNAME=
MITAKE_PASSWORD=
```

## 使用方式

#### 簡訊發送簡單範例

**Example:**

```php
<?php namespace Your\Namespace;

// ...

use Delta935142\Mitake\Newsletter;

class YourClass
{
    public function yourMethod()
    {
        Newsletter::smSend($phone, $message);
    }
}
```

#### 查詢簡訊範例

**Example:**

```php
<?php namespace Your\Namespace;

// ...

use Delta935142\Mitake\Newsletter;

class YourClass
{
    public function yourMethod()
    {
        Newsletter::smQuery();
    }
}
```