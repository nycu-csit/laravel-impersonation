<div style="margin: 2rem auto;">
  <h1 style="text-align: center;">Impersonation</h1>
  <table style="margin: 0 auto;">
    <thead>
      <tr>
        @foreach($columns as $column)
          <th>{{ $column }}</th>
        @endforeach

        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
        <tr>
          @foreach($columns as $column)
            @if(is_array($user[$column]))
              <td>@json($user[$column])</td>
            @else
              <td>{{ $user[$column] }}</td>
            @endif
          @endforeach

          <td>
            <form method="POST">
              {{ csrf_field() }}
              <input name="id" value="{{ $user[$authIdentifierName] }}" hidden />
              <button>Impersonate</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<style>
/**
 * Josh's Custom CSS Reset
 * https://www.joshwcomeau.com/css/custom-css-reset/
 */

*, *::before, *::after {
  box-sizing: border-box;
  font-family: sans-serif;
}

* {
  margin: 0;
}

body {
  line-height: 1.5;
  -webkit-font-smoothing: antialiased;
}

img, picture, video, canvas, svg {
  display: block;
  max-width: 100%;
}

input, button, textarea, select {
  font: inherit;
}

p, h1, h2, h3, h4, h5, h6 {
  overflow-wrap: break-word;
}

table, th, td {
  border: 1px solid black;
}
</style>
