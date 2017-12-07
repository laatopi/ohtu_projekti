<?php

class KayttajaController extends BaseController {

    public static function login() {
        View::make('kayttaja/login.html');
    }

    public static function create() {
        View::make('kayttaja/signup.html');
    }

    public static function store() {
        $params = $_POST;
        $attributes = array(
            'tunnus' => $params['tunnus'],
            'salasana' => $params['salasana']
        );
        $kayttaja = new Kayttaja($attributes);
        $errors = $kayttaja->errors();
        if (count($errors) == 0) {
            $kayttaja->save();
            Redirect::to('/lukuvinkki', array('message' => 'Käyttäjätunnus on luotu onnistuneesti!'));
        } else {
            View::make('kayttaja/signup.html', array('errors' => $errors));
        }
    }

    public static function logout() {
        $_SESSION['kayttaja'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function handle_login() {
        $params = $_POST;
        $kayttaja = Kayttaja::authenticate($params['tunnus'], $params['salasana']);
        if (!$kayttaja) {
            View::make('kayttaja/login.html', array('errors' => 'Väärä käyttäjätunnus tai salasana!', 'tunnus' => $params['tunnus']));
        } else {
            $_SESSION['kayttaja'] = $kayttaja->id;
            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $kayttaja->tunnus . '!'));
        }
    }

    public static function show() {
        self::check_logged_in();
        $kayttaja = parent::get_user_logged_in();
        View::make('kayttaja/show.html', array('message' => 'Täällä ei ole vielä mitään!', 'kayttaja' => $kayttaja));
    }

    public static function showUsersTips() {
        self::check_logged_in();
        $kayttaja = parent::get_user_logged_in();
        //$status = Status::findStatus($kayttaja->id);

        $vinkit = KayttajaLukuvinkki::findTips($kayttaja->id);
        
        foreach ($vinkit as $vinkki) {
            $kayttajaid = $kayttaja->id;
            $lukuvinkkid = $vinkki->lukuvinkki_id;
            $staattus = Status::findStatus($kayttajaid, $lukuvinkkid);
            $vinkki->status = $staattus;
        }
        
        View::make('kayttaja/vinkit.html', array('vinkit' => $vinkit, 'kayttaja' => $kayttaja));
    }
    
    public static function addTip($id) {
        $kayttaja = parent::get_user_logged_in();
        $vinkki = new KayttajaLukuvinkki(array(
            'kayttaja_id' => $kayttaja->id,
            'lukuvinkki_id' => $id
        ));
        if (!KayttajaLukuvinkki::find($id, $kayttaja->id)) {
            $vinkki->save($id, $kayttaja->id);


            Redirect::to('/user', array('message' => 'Lukuvinkki on lisätty käyttäjälle onnistuneesti!'));
        }
        Redirect::to('/user', array('error' => 'Lukuvinkki on jo lisätty käyttäjälle!'));
    }

    public static function removeTip($lukuvinkki_id) {
        $kayttaja = parent::get_user_logged_in();
        $vinkki = new KayttajaLukuvinkki(array(
            'kayttaja_id' => $kayttaja->id,
            'lukuvinkki_id' => $lukuvinkki_id
        ));
        $vinkki->destroy($lukuvinkki_id, $kayttaja->id);

        Redirect::to('/user', array('message' => 'Lukuvinkki on poistettu'));
    }

    public static function flipStatus($lukuvinkki_id) {
        $kayttaja = parent::get_user_logged_in();
        $status = Status::find($kayttaja->id,$lukuvinkki_id);
        if($status==NULL) {
            self::addStatus($lukuvinkki_id);
        } else {
            self::removeStatus($lukuvinkki_id);
        }
    }

    public static function addStatus($lukuvinkki_id) {
        $kayttaja = parent::get_user_logged_in();
        $status = new Status(array(
            'kayttaja_id' => $kayttaja->id,
            'lukuvinkki_id' => $lukuvinkki_id,
            'status' => 1
        ));
        $status->save($lukuvinkki_id, $kayttaja->id);

        Redirect::to('/lukuvinkki/'.$lukuvinkki_id, array('message' => 'Status on muutettu käyttäjälle: luettu'));
    }

    public static function removeStatus($lukuvinkki_id) {
        $kayttaja = parent::get_user_logged_in();
        $status = new Status(array(
            'kayttaja_id' => $kayttaja->id,
            'lukuvinkki_id' => $lukuvinkki_id,
            'status' => 0
        ));
        $status->destroy($kayttaja->id, $lukuvinkki_id);

        Redirect::to('/lukuvinkki/'.$lukuvinkki_id, array('message' => 'Status on muutettu käyttäjälle: ei luettu'));
    }

}
