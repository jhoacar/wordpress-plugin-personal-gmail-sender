<div style="background-color:#f45757; color:white;padding:1rem;border: solid 1px black;">
    <h1 style="color:black;">Numbers Analyzer Plugin Error:</h1>
    <h2>
        <strong>Message:</strong>
        <span style="font-weight:normal">
            {!! $error->getMessage() !!}
        </span>
    </h2>
    <h2>
        <strong>Code:</strong>
        <span style="font-weight:normal">
            {!! $error->getCode() !!}
        </span>
    </h2>
    <h2>
        <strong>File:</strong>
        <span style="font-weight:normal">
            {!! $error->getFile() !!}
        </span>
    </h2>
    <h2>
        <strong>Line:</strong>
        <span style="font-weight:normal">
            {!! $error->getLine() !!}
        </span>
    </h2>
    <h2>
        <strong>Trace:</strong>
        <span style="font-weight:normal">
            {!! $error->getTraceAsString() !!}
        </span>
    </h2>
</div>