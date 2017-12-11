Feature: User can log in with valid username/password-combination

    Scenario: user can register with correct password
      Given frontpage is entered
       Given signup is pressed
       When  username "matti" and password "tatti1" are entered
       Then  system will respond with success

    Scenario: user can login with correct password
      Given frontpage is entered
      Then kirjaudu sisaan is pressed
      When  username "matti" and password "tatti1" are entered
      Then  system will respond with success

    Scenario: user can add kirja
      Given frontpage is entered
      Then lisaa lukuvinkki is pressed
      When  "kirja" is selected
      When  correct kirja params submitted
      Then  system will respond with success

    Scenario: user can edit added kirja
      Given frontpage is entered
      When  "Samin seikkailut Amsterdamissa" is chosen
      Then  muokkaa is pressed
      Then  subjects are edited
      Then  system will respond with success  

    Scenario: user can delete added kirja
      Given frontpage is entered
      When  "Joakim Merihädässä" is chosen
      Then  poista is pressed
      Then  system will respond with success

    Scenario: user can add podcast
      Given frontpage is entered
      Then lisaa lukuvinkki is pressed
      When  "podcast" is selected
      When  correct podcast params submitted
      Then  system will respond with success

    Scenario: user can edit added podcast
      Given frontpage is entered
      When  "Salaisuuksia Serenassa" is chosen
      Then  muokkaa is pressed
      Then  podcast is edited
      Then  system will respond with success  

    Scenario: user can delete added podcast
      Given frontpage is entered
      When  "Sotkua Sealifessa" is chosen
      Then  poista is pressed
      Then  system will respond with success

    Scenario: user can add blogpost
      Given frontpage is entered
      Then lisaa lukuvinkki is pressed
      When  "blogpost" is selected
      When  correct blogpost params submitted
      Then  system will respond with success

    Scenario: user can edit added blogpost
      Given frontpage is entered
      When  "Tiistain turinat" is chosen
      Then  muokkaa is pressed
      Then  blogpost is edited
      Then  system will respond with success  

    Scenario: user can delete added blogpost
      Given frontpage is entered
      When  "Torstain torikokous" is chosen
      Then  poista is pressed
      Then  system will respond with success


    Scenario: user can add video
      Given frontpage is entered
      Then lisaa lukuvinkki is pressed
      When  "video" is selected
      When  correct video params submitted
      Then  system will respond with success

    Scenario: user can edit added video
      Given frontpage is entered
      When  "Linkin parkin paras biisi" is chosen
      Then  muokkaa is pressed
      Then  video is edited
      Then  system will respond with success  

    Scenario: user can delete added video
      Given frontpage is entered
      When  "Limp Bizkitin paras biisi" is chosen
      Then  poista is pressed
      Then  system will respond with success

