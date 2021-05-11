##The game "Цу-е-фа"
###Deployment:
```
    docker-compose build
    docker-compose up -d
    docker-compose exec service composer install
    docker-compose exec service bash
    composer install # зачем дважды composer insatall?
    echo y |./bin/console d:m:m  # bin/console d:m:m --no-interaction или bin/console d:m:m -n
```

###How to play

```
    docker-compose exec service ./bin/console game:run
```
Custom command parameters
```
Options:
  -r, --random=RANDOM                This parameter specifies the selection of one character. He will always choose paper or random value. False = always choose paper. True = always choose random [default: false]
  -f, --report-format=REPORT-FORMAT  Report formant. Value: ["json","console"] [default: "console"]
  -gr, --game-rounds=GAME-ROUNDS     number of rounds in the game [default: 100]
```

Code coverage
```
     docker-compose exec service ./vendor/bin/phpunit --coverage-html=coverage
```

open file `./coverage/index.html` in browser