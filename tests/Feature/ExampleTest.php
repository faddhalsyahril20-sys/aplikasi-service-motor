<?php

it('menampilkan halaman aplikasi service motor', function () {
    $response = $this->get('/service-motor');

    $response->assertStatus(200);
});
