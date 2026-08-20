<?php

it('can render', function () {
    $contents = $this->view('nosotros', [
        //
    ]);

    $contents->assertSee('');
});
