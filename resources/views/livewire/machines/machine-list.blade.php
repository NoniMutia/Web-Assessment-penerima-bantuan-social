<div>
    <main id="main" class="main">
        <div class="pagetitle">
        {{-- <h3>Wash Machines</h3> --}}
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a wire:navigate href="{{ route('wash_machines') }}">WASH MACHINES</a></li>
            </ol>
        </nav>
        </div><!-- End Page Title -->

        <section class="section wash-machines">
            {{-- Alert for Validation --}}
            @if ($errors->any())
                <div class="pt-3">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Success Alert --}}
            @if (session()->has('message'))
                <div class="pt-3">
                    <div class="alert alert-success">
                        {{ session('message'); }}
                    </div>
                </div>
            @endif

            <!-- Form Input -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info text-light">FORM</div>
                        <div class="card-body">
                            <div class="row mt-1">
                                <div class="col-md-2">
                                    <input type="text" class="form-control fw-light" wire:model="no_machine" disabled="true" placeholder="No Machine...">
                                </div>
                                <div class="col-md-2">
                                    <select class="form-select fw-light" wire:model="type_machine">
                                        <option value="Washer">Washer</option>
                                        <option value="Dryer">Washer</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control fw-light" wire:model="seri" placeholder="Series...">
                                </div>
                                <div class="col-md-4">
                                    @if ($updateMode == true)
                                        <button type="button" class="btn btn-info btn-sm text-light" wire:click="updateMachine()">
                                            <i class="bi bi-check2-square"></i> Update
                                        </button>
                                    @else                           
                                        <button type="button" class="btn btn-success btn-sm" wire:click="saveMachine()">
                                            <i class="bi bi-sd-card"></i> Save
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Table -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="p-1 mb-1 bg-secondary">
                                <input type="text" class="form-control" placeholder="Search Data ..." wire:model.live="keyword">
                            </div>
                            <table class="table table-hover table-striped" border="1">
                                <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Number</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Series</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tm_machines as $key => $machine)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{  $machine->no_machine }}</td>
                                        <td>{{  $machine->type_machine }}</td>
                                        <td>{{  $machine->seri }}</td>
                                        <td>
                                            <a wire:click="loadUpdate('{{ $machine->no_machine }}')" class="btn btn-warning btn-sm">
                                                <i class="bi bi-upload"></i>
                                            </a>
                                            <a wire:click="deleteConfirmation('{{ $machine->no_machine }}')" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delModal">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $tm_machines->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="delModal" tabindex="-1" aria-labelledby="delModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-info text-light">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Confirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure want to delete this data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" wire:click="deleteMachine()" data-bs-dismiss="modal">Yes</button>
            </div>
            </div>
        </div>
    </div>
</div>
