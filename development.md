# A guide for developers

## Create a new processor class
- Create a new class in the `src/Processors` directory
  - The class should extend `IanRothmann\AINinja\Processors\AINinjaProcessor`
  - Implement the getEndpoint() method to return a string with the endpoint of the processor, e.g. 'summarize'
  - Decide on the type of the result class to be used. If there is just a single value, like for summarization or Json generation, you can use the generic AINinjaResult class. If there are multiple values, like for translation, you should create a new class that extends AINinjaResult class. Otherwise, create a new result class.
  - Return the result class in the processor's getResultClass() method, for example `return AINinjaResult::class;`
  - Implement input methods that is fluent with proper method names in english, following camelCase. For each input, alter the `$this->input` array or use `$this->setInputParameter($key', $value);`
  - If the processor takes an output language, use the `OutputsInLangaue` trait on your processor.
  - Make sure to also return sample / mock data in a `getMocked()` function. This is a mixed type, but usually array or string.
  - Finally, implement the `get()` function and specify the Result class as the return type:

```php
public function get(): AINinjaResult
{
   return parent::get();
}
```

## Create a new result class
- If the result has multiple fields, implement a new result class in the `src/Results` directory.
- The class should extend `IanRothmann\AINinja\Results\AINinjaResult`. 
- Create getter functions for each. Be sure to check for null safety and keys that exist. Use Laravel collections `->get()` if required.

## Implement the processor so it can be called from the Facade
- Create a function that returns a new instance of the processor in the `src/AINinja.php` file.
- Make sure to give it a descriptive name as a verb. Such as `summarize()` or `generateJobDescription()`

## Write a unit test
- Create a dedicated file for the test in `tests/Unit`, that matches the name of the processor, with the name ending in `Test`.
- Do a basic evaluation of returned data, using the data you returned in the processor's mock function.
- Execute the integration test with `./vendor/bin/pest --filter=[TESTNAME]`
- To execute all integration tests, use `./vendor/bin/pest --filter=Unit`

## Write an integration test
- Create a dedicated file for the test in `tests/Integration`, that matches the name of the processor, with the name ending in `Test`.
- Do a basic evaluation of returned data.
- Execute the integration test with `./vendor/bin/pest --filter=[TESTNAME]`
- To execute all integration tests, use `./vendor/bin/pest --filter=Integration`
