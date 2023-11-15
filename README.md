# Huawei Cloud OBS for Laravel

[Huawei Cloud OBS](https://support.huaweicloud.com/devg-obs_php_sdk_doc_zh/zh-cn_topic_0132036136.html) storage for Laravel based on [bjphp/laravel-filesystem-obs](https://github.com/bjphp/laravel-filesystem-obs).
File private download Url:

# Requirement

- PHP >= 7.3.1

# Installation

```shell
$ composer require "sakuara-bj/laravel-filesystem-obs" -vvv
```

# Usage
```php
use Obs\ObsClient;
use Shopex\Obs\ObsAdapter;
use League\Flysystem\Filesystem;

$conf['key'] = 'xxx';
$conf['secret'] = 'xxx';
$conf['endpoint'] = 'xxx';
$conf['region'] = 'xxx';

$client = new ObsClient($config);

$debug = $config['debug'] ?? false;
$endpoint = $config['endpoint'] ?? '';
$cdn_domain = $config['cdn_domain'] ?? '';
$ssl_verify = $config['ssl_verify'] ?? false;

$filesystem = new Filesystem(new ObsAdapter($client, $bucket, $endpoint, $cdn_domain, $ssl_verify));
```

## API

```php
bool $flysystem->write('file.md', 'contents');

bool $flysystem->write('file.md', 'http://httpbin.org/robots.txt', ['mime' => 'application/redirect302']);

bool $flysystem->writeStream('file.md', fopen('path/to/your/local/file.jpg', 'r'));

bool $flysystem->update('file.md', 'new contents');

bool $flysystem->updateStream('file.md', fopen('path/to/your/local/file.jpg', 'r'));

bool $flysystem->rename('foo.md', 'bar.md');

bool $flysystem->copy('foo.md', 'foo2.md');

bool $flysystem->delete('file.md');

bool $flysystem->has('file.md');

string|false $flysystem->read('file.md');

array $flysystem->listContents();

array $flysystem->getMetadata('file.md');

int $flysystem->getSize('file.md');

string $flysystem->getAdapter()->getUrl('file.md'); 

string $flysystem->getMimetype('file.md');

int $flysystem->getTimestamp('file.md');

```

### Plugins

File Url: 

```php
use Shopex\Obs\Plugins\CreatePostSignature;

$flysystem->addPlugin(new CreatePostSignature());

array $flysystem->createPostSignature([
    'Bucket' => $bucket,
    'Key' => $key,
    'Expires' => 3600,
])->toArray();
```

# License
MIT