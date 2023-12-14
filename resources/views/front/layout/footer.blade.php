<footer>
      <div class="page-container">
        <a href="{{ route('index') }}" class="logo"><img src="{{ asset($setting->logo_2) }}"></a>
        <div class="footer-columns">
          <div class="footer-column">
            <p>{{ $contact->address }}</p>
            <a href="mailto:{{ $contact->email_4 }}">{{ $contact->email_4 }}</a>
          </div>

          <div class="footer-column-right">
          @foreach($social as $link)
            <a href="{{ $link->link }}" title="{{ $link->title }}" target="_blank">
              <img src="{{ asset($link->icon) }}" alt="{{ $link->title }}">
            </a>
            @endforeach

          </div>
        </div>
      </div>
      
    </footer>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="{{ asset('/front/assets/js/main.js') }}"></script>
  </body>
</html>
