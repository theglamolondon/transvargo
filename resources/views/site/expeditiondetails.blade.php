@extends('layouts._site')

@section('content')
    <section class="container-fluid">
        <div class="col-md-8 col-sm-5 col-xs-12">

            <div class="col-md-12 col-sm-12 col-xs-12">
            </div>
        </div>
        <div class="">
            <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a href="#recap">Récapitulatif</a>
                </li>
                <li role="presentation"><a href="#progression">Progression</a></li>
                <li role="presentation"><a href="#document">Documents</a></li>
            </ul>
            <div class="tab-content">
                <div id="recap" class="tab-pane fade in active">
                    <h3>Menu 1</h3>
                    <p>Some content in menu 1.</p>
                </div>

                <div id="progression" class="tab-pane fade">
                    <h3>Menu 2</h3>
                    <p>Some content in menu 2.</p>
                </div>

                <div id="document"class="tab-pane fade">
                    <h3>Menu 3</h3>
                    <p>Some content in menu 3.</p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

@endsection