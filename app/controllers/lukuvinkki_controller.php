<?php

class LukuvinkkiController extends BaseController {

    public static function index() {
        $lukuvinkit = Lukuvinkki::all();
        View::make('lukuvinkki/index.html', array('lukuvinkit' => $lukuvinkit));
    }

    public static function choose() {
        View::make('lukuvinkki/new.html');
    }

    public static function show($id) {
        $lukuvinkki = Lukuvinkki::find($id);
        $tags = LukuvinkkiTag::findTags($id);
        $kayttaja = parent::get_user_logged_in();
        if(!$kayttaja==NULL) {
            $status = Status::find($kayttaja->id,$id);
        } else {
            $status ="";
        }

        if ($tags == NULL) {
            $tags = "";
        }
        View::make('lukuvinkki/show.html', array('lukuvinkki' => $lukuvinkki, 'tags' => $tags, 'status' => $status));
    }

    public static function edit($id) {
        $lukuvinkki = Lukuvinkki::find($id);
        $tags = Tag::all();

        View::make('lukuvinkki/edit.html', array('attributes' => $lukuvinkki, 'tags' => $tags));
    }

    public static function storeKirja() {
        $params = $_POST;
        $tags = Tag::all();

        $attributes = array(
            'otsikko' => $params['otsikko'],
            'tekija' => $params['tekija'],
            'isbn' => $params['isbn'],
            'url' => null,
            'tyyppi' => 'kirja',
            'kuvaus' => $params['kuvaus'],
            'julkaistu' => $params['julkaistu'],
            'sarja' => null
        );

        $lukuvinkki = new Lukuvinkki($attributes);

        $errors = $lukuvinkki->errors();

        if (count($errors) == 0) {
            $lukuvinkki->save();

            $vinkki_controller = new LukuvinkkiController;
            $vinkki_controller->handeTags($params, $lukuvinkki);

            Redirect::to('/lukuvinkki/' . $lukuvinkki->id, array('message' => 'Lukuvinkki on lisätty!'));
        } else {
            View::make('lukuvinkki/kirja.html', array('errors' => $errors, 'attributes' => $attributes, 'tags' => $tags));
        }
    }

    public static function storePodcast() {
        $params = $_POST;
        $tags = Tag::all();

        $attributes = array(
            'otsikko' => $params['otsikko'],
            'tekija' => $params['tekija'],
            'isbn' => null,
            'url' => $params['url'],
            'tyyppi' => 'podcast',
            'kuvaus' => $params['kuvaus'],
            'julkaistu' => $params['julkaistu'],
            'sarja' => $params['sarja']
        );

        $lukuvinkki = new Lukuvinkki($attributes);

        $errors = $lukuvinkki->errors();

        if (count($errors) == 0) {
            $lukuvinkki->save();

            $vinkki_controller = new LukuvinkkiController;
            $vinkki_controller->handeTags($params, $lukuvinkki);

            Redirect::to('/lukuvinkki/' . $lukuvinkki->id, array('message' => 'Lukuvinkki on lisätty!'));
        } else {
            View::make('lukuvinkki/podcast.html', array('errors' => $errors, 'attributes' => $attributes, 'tags' => $tags));
        }
    }

    public static function storeBlogpost() {
        $params = $_POST;
        $tags = Tag::all();

        $attributes = array(
            'otsikko' => $params['otsikko'],
            'tekija' => $params['tekija'],
            'isbn' => null,
            'url' => $params['url'],
            'tyyppi' => 'blogpost',
            'kuvaus' => $params['kuvaus'],
            'julkaistu' => $params['julkaistu'],
            'sarja' => $params['sarja']
        );

        $lukuvinkki = new Lukuvinkki($attributes);

        $errors = $lukuvinkki->errors();

        if (count($errors) == 0) {
            $lukuvinkki->save();

            $vinkki_controller = new LukuvinkkiController;
            $vinkki_controller->handeTags($params, $lukuvinkki);

            Redirect::to('/lukuvinkki/' . $lukuvinkki->id, array('message' => 'Lukuvinkki on lisätty!'));
        } else {
            View::make('lukuvinkki/blogpost.html', array('errors' => $errors, 'attributes' => $attributes, 'tags' => $tags));
        }
    }

    public static function storeVideo() {
        $params = $_POST;
        $tags = Tag::all();

        $attributes = array(
            'otsikko' => $params['otsikko'],
            'tekija' => $params['tekija'],
            'isbn' => null,
            'url' => $params['url'],
            'tyyppi' => 'video',
            'kuvaus' => $params['kuvaus'],
            'julkaistu' => $params['julkaistu'],
            'sarja' => null
        );

        $lukuvinkki = new Lukuvinkki($attributes);

        $errors = $lukuvinkki->errors();

        if (count($errors) == 0) {
            $lukuvinkki->save();

            $vinkki_controller = new LukuvinkkiController;
            $vinkki_controller->handeTags($params, $lukuvinkki);

            Redirect::to('/lukuvinkki/' . $lukuvinkki->id, array('message' => 'Lukuvinkki on lisätty!'));
        } else {
            View::make('lukuvinkki/video.html', array('errors' => $errors, 'attributes' => $attributes, 'tags' => $tags));
        }
    }

    public function handeTags($params, $lukuvinkki) {
        $tagit = $params['tagit'];

        try {
            $tags = $params['tags'];

            foreach ($tags as $tag) {
                $tag = new LukuvinkkiTag(array('lukuvinkki_id' => $lukuvinkki->id, 'tag_id' => $tag));
                $tag->save();
            }

            if ($tagit != null) {
                $tagi = explode(',', $tagit);
                foreach ($tagi as $t) {
                    $t = new Tag(array('nimi' => $t));
                    $t->save();
                    $tagid = $t->id;
                    $t = new LukuvinkkiTag(array('lukuvinkki_id' => $lukuvinkki->id, 'tag_id' => $tagid));
                    $t->save();
                }
            }

        } catch (Exception $ex) {

        }
    }

    public static function update($id) {
        $params = $_POST;
        $tags = Tag::all();
        $vinkki = Lukuvinkki::find($id);
        Kint::dump($vinkki);
        $tyyppi = $vinkki->tyyppi;
        $attributes = array();

        if ($tyyppi == 'kirja') {
            $attributes = array(
                'otsikko' => $params['otsikko'],
                'tekija' => $params['tekija'],
                'isbn' => $params['isbn'],
                'url' => null,
                'tyyppi' => $tyyppi,
                'kuvaus' => $params['kuvaus'],
                'julkaistu' => $params['julkaistu'],
                'sarja' => null
            );
        } else if ($tyyppi == 'video') {
            $attributes = array(
                'otsikko' => $params['otsikko'],
                'tekija' => $params['tekija'],
                'isbn' => null,
                'url' => $params['url'],
                'tyyppi' => $tyyppi,
                'kuvaus' => $params['kuvaus'],
                'julkaistu' => $params['julkaistu'],
                'sarja' => null
            );
        } else {
            $attributes = array(
                'otsikko' => $params['otsikko'],
                'tekija' => $params['tekija'],
                'isbn' => null,
                'url' => $params['url'],
                'tyyppi' => $tyyppi,
                'kuvaus' => $params['kuvaus'],
                'julkaistu' => $params['julkaistu'],
                'sarja' => $params['sarja']
            );
        }

        $lukuvinkki = new Lukuvinkki($attributes);
        $errors = $lukuvinkki->errors();

        $tags = array();
        $tagit = array();

        if (isset($params['tags'])) {
            $tags = $params['tags'];
        }
        if (isset($params['tagit'])) {
            $tagit = $params['tagit'];
        }

        if (count($errors) == 0) {
            $lukuvinkki->update($id);
            LukuvinkkiTag::destroy($id);

            try {                
                foreach ($tags as $tag) {
                    $tag = new LukuvinkkiTag(array('lukuvinkki_id' => $id, 'tag_id' => $tag));
                    $tag->save();
                }

                if ($tagit != null) {
                    $tagi = explode(',', $tagit);
                    foreach ($tagi as $t) {
                        $t = new Tag(array('nimi' => $t));
                        $t->save();
                        $tagid = $t->id;
                        $t = new LukuvinkkiTag(array('lukuvinkki_id' => $id, 'tag_id' => $tagid));
                        $t->save();
                    }
                }

            } catch (Exception $ex) {
            }

            Redirect::to('/lukuvinkki/' . $id, array('message' => 'Lukuvinkkiä on muokattu onnistuneesti!'));
        } else {
            View::make('lukuvinkki/edit.html', array('errors' => $errors, 'attributes' => $attributes, 'tags' => $tags));
        }
    }

    public static function destroy($id) {
        $lukuvinkki = new Lukuvinkki(array('id' => $id));
        $lukuvinkki->destroy();

        Redirect::to('/lukuvinkki', array('message' => 'Lukuvinkki on poistettu onnistuneesti!'));
    }

    public static function createKirja() {
        $tags = Tag::all();
        View::make('lukuvinkki/kirja.html', array('tags' => $tags));
    }

    public static function createPodcast() {
        $tags = Tag::all();
        View::make('lukuvinkki/podcast.html', array('tags' => $tags));
    }

    public static function createBlogpost() {
        $tags = Tag::all();
        View::make('lukuvinkki/blogpost.html', array('tags' => $tags));
    }

    public static function createVideo() {
        $tags = Tag::all();
        View::make('lukuvinkki/video.html', array('tags' => $tags));
    }


}
