Feature: User can log in with valid username/password-combination

    Scenario: user can register with correct password
       Given signup is pressed
       When  username "matti" and password "tatti1" are entered
       Then  system will respond with success

    Scenario: user can login with correct password
      Given kirjaudu sisaan is pressed
      When  username "matti" and password "tatti1" are entered
      Then  system will respond with success

    Scenario: user can add and delete lukuvinkki
      Given lisaa lukuvinkki is pressed
      When  kirja is selected
      When  correct params submitted
      Then  system will respond with success
