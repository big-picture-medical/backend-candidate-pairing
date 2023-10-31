## Prerequisites 

- [Docker](https://www.docker.com/)

## Setup

1. Clone this repo to your local machine.
2. Copy over the env `cp .env.example .env`.
3. Install dependencies...

```sh
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

4. Build and start the Laravel Sail docker container with `./vendor/bin/sail up -d`.
5. Run the test suite and it should be passing with `./vendor/bin/sail test`.

## What we're looking for

* Idiomatic, conventional Laravel
* Knowledge of Laravel features and the appropriate usage (this isn't "Laravel Bingo", so don't feel you need to show off everything you know if it doesn't suit the tasks)
* Simple, readable code
* Tests as documentation

## Good to know

* There are many valid ways to solve this. Don't panic about choosing a particular approach over another. Feel free to document the reasons for your decisions if you like, or we can discuss it afterwards.
* We are mindful of your time and have tried to simplify the scenarios from what might happen in reality. For example, in reality, the medication dosage would benefit from being stored with more structure. Feel free to let us know any gaps you've found, but please don't feel any pressure to make it 100% real-world ready.
* There are no trick questions. We're on the same team. If something seems wrong, please don't be afraid to bring it up or ask questions, but know that nothing is deliberately wrong in the codebase.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
