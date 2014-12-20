@layout('template.main')
@section('head')

 
@endsection

@section('content')

	<div id="main">

		<!-- Main Title -->
		<div class="icon"></div>
		<h1 class="title">Live Search Tutorial</h1>
		<h5 class="title">(searches through php functions and shows them on php.net)</h5>

		<!-- Main Input -->
		<table><Tr><td>
		<input type="text" id="search" autocomplete="off"></td><td><ul id="results"></ul></td>
		</tr>
		<tr><td>
		<input type="text" id="searchsatu" autocomplete="off"></td><td><ul id="resultssatu"></ul></td>
		</tr>
		<tr><td>
		<input type="text" id="searchdua" autocomplete="off"></td><td><ul id="resultsdua"></ul></td>
		</tr>
		
	</table>
		
			
{{ HTML::script('js/custom.js'); }}

@endsection