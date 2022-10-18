<div x-data wire:ignore x-init="
    FilePond.registerPlugin(FilePondPluginImagePreview);
    FilePond.setOptions({
        allowMultiple: {{isset($attributes['multiple']) ? 'true': 'false'}},
        server: {
            process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                /* store file somewhere and call `load` when done */
                @this.upload('{{$attributes['wire:model']}}', file, load, error, progress)
            },
            revert: (filename, load, error) => {
                @this.removeUpload('{{$attributes['wire:model']}}', filename, load)
            },
        }
    });

    FilePond.create($refs.input);
">
    <input type="file" x-ref="input" />

</div>