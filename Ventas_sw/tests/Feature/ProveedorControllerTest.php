<?php

namespace Tests\Feature;

use App\Models\Proveedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ProveedorControllerTest extends TestCase
{
    use RefreshDatabase; // Limpia la BD después de cada prueba
    use WithoutMiddleware;

    #[Test]
    public function un_usuario_puede_registrar_un_proveedor()
    {
        $response = $this->post('/proveedores', [
            'nombre' => 'Proveedor Test',
            'telefono' => '123456789',
            'email' => 'test@correo.com',
        ]);

        $response->assertStatus(302); // Verifica la redirección exitosa

        $this->assertDatabaseHas('proveedors', ['email' => 'test@correo.com']);
    }

    #[Test]
    public function no_se_puede_registrar_un_proveedor_sin_datos()
    {
        $response = $this->post('/proveedores', []);

        $response->assertSessionHasErrors(['nombre', 'telefono', 'email']);
    }

    #[Test]
    public function no_se_puede_registrar_un_proveedor_con_email_duplicado()
    {
        Proveedor::factory()->create(['email' => 'test@correo.com'])->setTable('proveedors');

        $response = $this->post('/proveedores', [
            'nombre' => 'Otro Proveedor',
            'telefono' => '987654321',
            'email' => 'test@correo.com',
        ]);

        $response->assertSessionHasErrors(['email']);
    }
}
