<?php


namespace app\controllers;

use app\models\Job;
use app\models\Verify;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use app\models\cities;

class UploadController extends SiteController
{

    public function actionJobadd()
    {
        if(!Yii::$app->user->isGuest) {

            if (Yii::$app->request->isPost) {
                $files =  UploadedFile::getInstancesByName('Job[file]');
                if($files[0] !== NULL){
                    for($i = 0; $i >= count($files); $i++){

                        array_push($files, $files->baseName . '.' . $files->extension);
                    }
                    $filename = date("Y-M-d-H-i-s-u").'---'. Yii::$app->user->id;
                    $path = mkdir( "../uploads/" . date("Y-M-d-H-i-s-u").'---'. Yii::$app->user->id   , 0777, true);
                    foreach ($files as $file) {
                        $file->saveAs("../uploads/". $filename .'/'  . $file->baseName . '.' . $file->extension);
                    }
                }

                $file = implode(',',$files);


                //Check if there is any job with this title, each title has to be unique because we use titles to show job.
                //if it's an object then there is a Job offer with the exact same title!

                if(Yii::$app->request->post("Job")['title']){
                    $typeof =  gettype(Job::findMatchTitle(Yii::$app->request->post("Job")['title'])[0]);
                    if( $typeof === 'object'){
                        $title = Yii::$app->request->post("Job")['title'];
                        $title .= time();
                    } else {
                        $title = Yii::$app->request->post("Job")['title'];
                    }
                }


                $link = $this->url_slug($title);
                $link_t = $link;
                $model = new Job([
                    'user_id' => Yii::$app->user->identity->id,
                    'title' => Yii::$app->request->post("Job")['title'],
                    'description' => Yii::$app->request->post("Job")['description'],
                    'howlong' => Yii::$app->request->post("Job")['howlong'],
                    'place' => Yii::$app->request->post("Job")['place'],
                    'pay' => Yii::$app->request->post("Job")['pay'],
                    'category' => Yii::$app->request->post("Job")['category'],
                    'link' => $link_t,
                    'expire_date' => Yii::$app->request->post("Job")['expire_date'],
                    'file' => $file,
                ]);

                $model->save();
                Yii::$app->session->setFlash('success', Yii::t('main','Job offer created successfully'));
            } else {
                Yii::$app->session->setFlash('error',\Yii::t('main', 'Something went wrong'));
        }
            $this->goHome();
        } else {
            $this->goHome();
            Yii::$app->session->setFlash('registerFirst' , \Yii::t('main', 'registerFirst'));
        }
    }

    public function actionVerifyuser()
    {

        if(!Yii::$app->user->isGuest) {

            if (Yii::$app->request->isPost) {
                $files =  UploadedFile::getInstancesByName('Verify[files]');
                if($files[0] !== NULL){
                    for($i = 0; $i >= count($files); $i++){
                        array_push($files, $files->baseName . '.' . $files->extension);
                    }
                    $filename = date("Y-M-d-H-i-s-u").'-Verify-Request-'. Yii::$app->user->id;
                    $path = mkdir( "../uploads/Verify-requests/" . date("Y-M-d-H-i-s-u").'-Verify-Request-'. Yii::$app->user->id   , 0777, true);
                    foreach ($files as $file) {
                        $file->saveAs("../uploads/Verify-requests/". $filename .'/'  . $file->baseName . '.' . $file->extension);
                    }
                }

                $file = implode(',',$files);

                $model = new Verify([
                    'user_id' => Yii::$app->user->identity->id,
                    'name_ar' => Yii::$app->request->post("Job")['name_ar'],
                    'name_en' => Yii::$app->request->post("Job")['name_en'],
                    'national_number' => Yii::$app->request->post("Job")['national_number'],
                    'sex' => Yii::$app->request->post("Job")['sex'],
                    'birth_date' => Yii::$app->request->post("Job")['birth_date'],
                    'city_of_birth' => Yii::$app->request->post("Job")['city_of_birth'],
                    'mother_name' =>  Yii::$app->request->post("Job")['mother_name'],
                    'reg_num_place' => Yii::$app->request->post("Job")['reg_num_place'],
                    'place_issue' =>  Yii::$app->request->post("Job")['place_issue'],
                    'place_residence' => Yii::$app->request->post("Job")['place_residence'],
                    'files' => $file,
                ]);

                $model->save();
                Yii::$app->session->setFlash('success', Yii::t('main','Job offer created successfully'));
            } else {
                Yii::$app->session->setFlash('error',\Yii::t('main', 'Something went wrong'));
            }
            $this->goHome();
        } else {
            $this->goHome();
            Yii::$app->session->setFlash('registerFirst' , \Yii::t('main', 'registerFirst'));
        }
    }
    public function url_slug($str, $options = array())
    {
        // Make sure string is in UTF-8 and strip invalid UTF-8 characters
        $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());

        $defaults = array(
            'delimiter' => '-',
            'limit' => null,
            'lowercase' => true,
            'replacements' => array(),
            'transliterate' => false,
        );

        // Merge options
        $options = array_merge($defaults, $options);

        $char_map = array(
            // Latin
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'AE',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ð' => 'D',
            'Ñ' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ő' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ű' => 'U',
            'Ý' => 'Y',
            'Þ' => 'TH',
            'ß' => 'ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'ae',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'd',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ő' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ü' => 'u',
            'ű' => 'u',
            'ý' => 'y',
            'þ' => 'th',
            'ÿ' => 'y',
            // Latin symbols
            '©' => '(c)',
            // Greek
            'Α' => 'A',
            'Β' => 'B',
            'Γ' => 'G',
            'Δ' => 'D',
            'Ε' => 'E',
            'Ζ' => 'Z',
            'Η' => 'H',
            'Θ' => '8',
            'Ι' => 'I',
            'Κ' => 'K',
            'Λ' => 'L',
            'Μ' => 'M',
            'Ν' => 'N',
            'Ξ' => '3',
            'Ο' => 'O',
            'Π' => 'P',
            'Ρ' => 'R',
            'Σ' => 'S',
            'Τ' => 'T',
            'Υ' => 'Y',
            'Φ' => 'F',
            'Χ' => 'X',
            'Ψ' => 'PS',
            'Ω' => 'W',
            'Ά' => 'A',
            'Έ' => 'E',
            'Ί' => 'I',
            'Ό' => 'O',
            'Ύ' => 'Y',
            'Ή' => 'H',
            'Ώ' => 'W',
            'Ϊ' => 'I',
            'Ϋ' => 'Y',
            'α' => 'a',
            'β' => 'b',
            'γ' => 'g',
            'δ' => 'd',
            'ε' => 'e',
            'ζ' => 'z',
            'η' => 'h',
            'θ' => '8',
            'ι' => 'i',
            'κ' => 'k',
            'λ' => 'l',
            'μ' => 'm',
            'ν' => 'n',
            'ξ' => '3',
            'ο' => 'o',
            'π' => 'p',
            'ρ' => 'r',
            'σ' => 's',
            'τ' => 't',
            'υ' => 'y',
            'φ' => 'f',
            'χ' => 'x',
            'ψ' => 'ps',
            'ω' => 'w',
            'ά' => 'a',
            'έ' => 'e',
            'ί' => 'i',
            'ό' => 'o',
            'ύ' => 'y',
            'ή' => 'h',
            'ώ' => 'w',
            'ς' => 's',
            'ϊ' => 'i',
            'ΰ' => 'y',
            'ϋ' => 'y',
            'ΐ' => 'i',
            // Turkish
            'Ş' => 'S',
            'İ' => 'I',
            'Ç' => 'C',
            'Ü' => 'U',
            'Ö' => 'O',
            'Ğ' => 'G',
            'ş' => 's',
            'ı' => 'i',
            'ç' => 'c',
            'ü' => 'u',
            'ö' => 'o',
            'ğ' => 'g',
            // Russian
            'А' => 'A',
            'Б' => 'B',
            'В' => 'V',
            'Г' => 'G',
            'Д' => 'D',
            'Е' => 'E',
            'Ё' => 'Yo',
            'Ж' => 'Zh',
            'З' => 'Z',
            'И' => 'I',
            'Й' => 'J',
            'К' => 'K',
            'Л' => 'L',
            'М' => 'M',
            'Н' => 'N',
            'О' => 'O',
            'П' => 'P',
            'Р' => 'R',
            'С' => 'S',
            'Т' => 'T',
            'У' => 'U',
            'Ф' => 'F',
            'Х' => 'H',
            'Ц' => 'C',
            'Ч' => 'Ch',
            'Ш' => 'Sh',
            'Щ' => 'Sh',
            'Ъ' => '',
            'Ы' => 'Y',
            'Ь' => '',
            'Э' => 'E',
            'Ю' => 'Yu',
            'Я' => 'Ya',
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'yo',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'j',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'c',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'sh',
            'ъ' => '',
            'ы' => 'y',
            'ь' => '',
            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya',
            // Ukrainian
            'Є' => 'Ye',
            'І' => 'I',
            'Ї' => 'Yi',
            'Ґ' => 'G',
            'є' => 'ye',
            'і' => 'i',
            'ї' => 'yi',
            'ґ' => 'g',
            // Czech
            'Č' => 'C',
            'Ď' => 'D',
            'Ě' => 'E',
            'Ň' => 'N',
            'Ř' => 'R',
            'Š' => 'S',
            'Ť' => 'T',
            'Ů' => 'U',
            'Ž' => 'Z',
            'č' => 'c',
            'ď' => 'd',
            'ě' => 'e',
            'ň' => 'n',
            'ř' => 'r',
            'š' => 's',
            'ť' => 't',
            'ů' => 'u',
            'ž' => 'z',
            // Polish
            'Ą' => 'A',
            'Ć' => 'C',
            'Ę' => 'e',
            'Ł' => 'L',
            'Ń' => 'N',
            'Ó' => 'o',
            'Ś' => 'S',
            'Ź' => 'Z',
            'Ż' => 'Z',
            'ą' => 'a',
            'ć' => 'c',
            'ę' => 'e',
            'ł' => 'l',
            'ń' => 'n',
            'ó' => 'o',
            'ś' => 's',
            'ź' => 'z',
            'ż' => 'z',
            // Latvian
            'Ā' => 'A',
            'Č' => 'C',
            'Ē' => 'E',
            'Ģ' => 'G',
            'Ī' => 'i',
            'Ķ' => 'k',
            'Ļ' => 'L',
            'Ņ' => 'N',
            'Š' => 'S',
            'Ū' => 'u',
            'Ž' => 'Z',
            'ā' => 'a',
            'č' => 'c',
            'ē' => 'e',
            'ģ' => 'g',
            'ī' => 'i',
            'ķ' => 'k',
            'ļ' => 'l',
            'ņ' => 'n',
            'š' => 's',
            'ū' => 'u',
            'ž' => 'z',
            //arab
            "ا" => "a",
            "أ" => "a",
            "إ" => "ie",
            "آ" => "aa",
            "ب" => "b",
            "ت" => "t",
            "ث" => "th",
            "ج" => "j",
            "ح" => "h",
            "خ" => "kh",
            "د" => "d",
            "ذ" => "thz",
            "ر" => "r",
            "ز" => "z",
            "س" => "s",
            "ش" => "sh",
            "ص" => "ss",
            "ض" => "dt",
            "ط" => "td",
            "ظ" => "thz",
            "ع" => "a",
            "غ" => "gh",
            "ف" => "f",
            "ق" => "q",
            "ك" => "k",
            "ل" => "l",
            "م" => "m",
            "ن" => "n",
            "ه" => "h",
            "و" => "w",
            "ي" => "e",
            "اي" => "i",
            "ة" => "tt",
            "ئ" => "ae",
            "ى" => "a",
            "ء" => "aa",
            "ؤ" => "uo",
            "َ" => "a",
            "ُ" => "u",
            "ِ" => "e",
            " ٌ" => "on",
            "ٍ" => "en",
            "ً" => "an",
            "تش" => "tsch",
        );

        // Make custom replacements
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

        // Transliterate characters to ASCII
        if ($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }

        // Replace non-alphanumeric characters with our delimiter
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

        // Remove duplicate delimiters
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

        // Truncate slug to max. characters
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

        // Remove delimiter from ends
        $str = trim($str, $options['delimiter']);

        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
    }
}
