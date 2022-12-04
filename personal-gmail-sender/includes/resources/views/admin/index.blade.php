@extends('layouts.template')
@section('content')
<div class="card mw-100">
    <div class="card-header">
        <h2>Numbers Analyzer Configuration</h2>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <h3 class="mb-1">
                If you need to add a
                <span class="text-success">iframe</span> or
                <span class="text-success">link</span>
                to go to
                <a href="http://{{ numbers_analyzer_plugin()->get('domain') }}">
                    {{ numbers_analyzer_plugin()->get('domain') }}
                </a>,
                with the current wordpress session.
                You need to create that element with the
                <span class="text-info">class</span> called
                <span class="badge badge-light-primary">
                    {{ numbers_analyzer_plugin()->get('class_link') }}
                </span>
            </h3>
            <div class="row mb-1">
                <h4>
                    <strong>Example:</strong>
                    <span class="badge badge-light-info">
                        &lt;a class="{{ numbers_analyzer_plugin()->get('class_link') }}">Go to Numbers Analyzer&lt;/a>
                    </span>
                </h4>
                <h4>
                    <strong>Result:</strong>
                    <a class="{{ numbers_analyzer_plugin()->get('class_link') }}">Go to Numbers Analyzer</a>
                </h4>
            </div>
            <div class="mb-1">
                <h4 class="row">
                    <div class="col-12">
                        <strong>Example:</strong>
                        <span class="badge badge-light-info">
                            &lt;iframe class="{{ numbers_analyzer_plugin()->get('class_link') }}">&lt;/iframe>
                        </span>
                    </div>
                </h4>
                <h4 class="row">
                    <div class="col-12">
                        <strong>Result:</strong>
                    </div>
                    <iframe class="col-12 border border-primary {{ numbers_analyzer_plugin()->get('class_link') }}"></iframe>
                </h4>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-md-6 col-12 mx-auto">
                    <div class="mb-1">
                        <label class="form-label">
                            Numbers Analyzer Domain (Actual: {{ numbers_analyzer_plugin()->get('domain') }})
                            <strong class="text-danger">*</strong>
                        </label>
                        <input name="domain" class="form-control" type="text" value="{{ numbers_analyzer_plugin()->get('domain') }}" placeholder="Please type the Numbers Analyzer Domain">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-12 mx-auto">
                    <div class="mb-1">
                        <label class="form-label" for="domain">
                            Numbers Analyzer Token (Actual: {{ numbers_analyzer_plugin()->get('token') }})
                            <strong class="text-danger">*</strong>
                        </label>
                        <input name="token" class="form-control" type="text" value="{{ numbers_analyzer_plugin()->get('token') }}" placeholder="Please type the Numbers Analyzer Token">
                        <div class="small text-muted mt-2">
                            This it is an
                            <span class="badge badge-light-info">environment variable</span>
                            that you can find in your Laravel application
                            <span class="badge badge-light-primary">(.env)</span>
                            called
                            <span class="badge badge-light-info">WORDPRESS_TOKEN</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-12 mx-auto">
                    <div class="mb-1">
                        <label class="form-label">
                            Numbers Analyzer Class Link (Actual: {{ numbers_analyzer_plugin()->get('class_link') }})
                            <strong class="text-danger">*</strong>
                        </label>
                        <input name="class_link" class="form-control" type="text" value="{{ numbers_analyzer_plugin()->get('class_link') }}" placeholder="Please type the Numbers Analyzer Class Link">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center">
                    <button class="btn btn-icon btn-success">
                        <i class="bi bi-save" class="me-25"></i>
                        <span>Save Configuration</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection