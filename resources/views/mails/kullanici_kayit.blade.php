<h1> {{config('app.name')}}</h1>
<p>Merhaba {{ $kullanici->adsoyad }}, kaydınız başarılı bir şekilde yapıldı.</p>
<p>Kaydınızı aktifleştirmek için <a href="{{config('app.url')}}/kullanici/aktifleştir/{{$kullanici->aktivasyon_anahtari}}">tıklayın</a>ve ya aşağıdaki bağlantıyı tarayıcınızda açın </p>
<p>{{config('app.url')}}/kullanici/aktifleştir/{{$kullanici->aktivasyon_anahtari}}</p>
