<div>
    @if (!empty($successMessage))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $successMessage }}
        </div>
    @endif

    @if ($catchError)
        <div class="alert alert-danger" id="success-danger">
            <button type="button" class="close" data-dismiss="alert"
                    wire:click="resetErrorMessage">x
            </button>
            {{ $catchError }}
        </div>
    @endif


    @if($show_parents)
        @include('livewire.parents')
    @else
        @include('livewire.steps')

        @include('livewire.father_form')

        @include('livewire.mother_form')

        @include('livewire.attachment')
    @endif

</div>

