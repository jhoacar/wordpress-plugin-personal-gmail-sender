<div style="border: solid 1px red;padding:1rem;">
    <h3 style="color:black;">Personal Gmail Sender Plugin Error:</h3>
    <h4>
        <strong>Message:</strong>
        <span style="font-weight:normal">
            {!! $error->getMessage() !!}
        </span>
    </h4>
    <h4>
        <strong>Code:</strong>
        <span style="font-weight:normal">
            {!! $error->getCode() !!}
        </span>
    </h4>
    <h4>
        <strong>File:</strong>
        <span style="font-weight:normal">
            {!! $error->getFile() !!}
        </span>
    </h4>
    <h4>
        <strong>Line:</strong>
        <span style="font-weight:normal">
            {!! $error->getLine() !!}
        </span>
    </h4>
    <h4>
        <strong>Trace:</strong>
        <span style="font-weight:normal">
            {!! $error->getTraceAsString() !!}
        </span>
    </h4>
</div>