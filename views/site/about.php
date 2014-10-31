<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <img src="<?=Yii::$app->request->baseUrl;?>/img/about.jpg" style="width:100%;">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Kuliah Kita adalah sistem informasi e-learning yang dibuat untuk mendukung sarana perkuliahan. Metode ini sangat cocok digunakan untuk mahasiswazaman sekarang karena bisa diakses kapan pun dan dimana pun, bahan-bahan kuliah dapat diunduh dari situs ini. Situs ini menunjang seluruh elemen perkuliahan sehinnga mahasiswa dan dosen tidak diharuskan untuk tatap muka langsung.</p>
	<p><b>Vision</b></p>
	<p>To become a leading center of online higher education program.</p>
	<p><b>Mission</b></p>
	<p>To broaden the access of learning, in higher education program and to helps individuals to achieve their educational and career goals, by providing flexible services & learning quality to empower the community.</p>
</div>
