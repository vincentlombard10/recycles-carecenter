@props(['report' => null])
<div id="po-{{ $report->id }}" popover>
    @if($report->isPending())
        <h5 class="mb-3">Démarrer l'édition du rapport d'expertise {{ $report->identifier }} ?</h5>
        {{ html()->form('patch', route('support.reports.start', $report))->open() }}
        <div class="d-grid mb-2"><input type="submit" class="btn btn-lg btn-primary" value="Oui"
                                        name="do"/>
        </div>
    @elseif($report->isPaused())
        <h5 class="mb-3">Reprendre l'édition du rapport d'expertise {{ $report->identifier }} ?</h5>
        <p>Quelle est la décision du client à propos du devis proposé ?</p>
        {{ html()->form('patch', route('support.estimates.update', $report->activeEstimate))->open() }}
        <div class="d-grid mb-2" style="grid-templa">
            <button type="submit" role="button" class="btn btn-lg btn-success mb-2" value="approved"
                    name="state">Devis
                accepté
            </button>
            <button type="submit" role="button" class="btn btn-lg btn-danger" value="rejected"
                    name="state">Devis
                refusé
            </button>
        </div>
    @endif
    {{ html()->form()->close() }}
    <div class="d-grid">
        <button popovertarget="po-{{ $report->id }}" popovertargetaction="hide" class="btn btn-sm">
            Annuler
        </button>
    </div>
</div>
