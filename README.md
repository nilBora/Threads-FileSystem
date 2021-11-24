# Thread on files

Simple realizing threads on files and system process. Is not prod).

## Example

```php
include_once "vendor/autoload.php";

use Jtrw\Process\ProcessFactory;
use Jtrw\Process\Store\FileStore;
use Jtrw\Sandbox\TestCommand;

$start = microtime(true);
$processOne = new ProcessFactory(new FileStore());
$processTwo = new ProcessFactory(new FileStore());
$processThree = new ProcessFactory(new FileStore());

$resultProcessOne = $processOne->run(new TestCommand(['name'=> 'Thread1', 'data'=> 'test1']));
$resultProcessTwo = $processTwo->run(new TestCommand(['name'=> 'Thread2', 'data'=> 'test2']));
$resultProcessThree = $processThree->run(new TestCommand(['name'=> 'Thread3', 'data'=> 'test3']));

print_r($resultProcessOne->getResponse());
print_r($resultProcessTwo->getResponse());
print_r($resultProcessThree->getResponse());

echo 'Time: '.(microtime(true) - $start).' sec.';
```

Test Class Command
```php
namespace Jtrw\Sandbox;

use Jtrw\Process\AbstractCommand;

class TestCommand extends AbstractCommand
{
    public function start()
    {
        sleep(5);
        $this->result = $this->getParams();
    }
}
```

In this class we did timeout in 5 seconds for each class. But in result we have time 5 seconds only.

## Result
```
Array
(
    [name] => Thread1
    [data] => test1
)
Array
(
    [name] => Thread2
    [data] => test2
)
Array
(
    [name] => Thread3
    [data] => test3
)
Time: 5.0416119098663 sec.% 
```