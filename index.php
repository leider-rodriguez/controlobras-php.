<?php
// ControlObras - Sitio Web Dinámico en PHP

$empresa = [
    "nombre" => "ControlObras",
    "eslogan" => "Gestión inteligente, control presupuestal y seguimiento técnico de obras",
    "ciudad" => "Pasto, Nariño - Colombia",
    "correo" => "contacto@controlobras.co",
    "telefono" => "+57 300 000 0000"
];

$servicios = [
    [
        "titulo" => "Control Presupuestal",
        "descripcion" => "Monitoreo en tiempo real del presupuesto aprobado frente al gasto ejecutado en materiales y mano de obra."
    ],
    [
        "titulo" => "Avance Físico de Obra",
        "descripcion" => "Seguimiento por capítulos constructivos desde cimentación y estructura hasta acabados arquitectónicos."
    ],
    [
        "titulo" => "Reportes Técnicos",
        "descripcion" => "Generación automática de balances, saldos disponibles e indicadores de cumplimiento para clientes e interventoría."
    ]
];

$proyectos = [
    [
        "nombre" => "Casa Campestre San Lorenzo",
        "ubicacion" => "San Lorenzo, Nariño",
        "categoria" => "Arquitectura Residencial",
        "presupuesto" => 185000000,
        "ejecutado" => 118400000,
        "estado" => "En ejecución"
    ],
    [
        "nombre" => "Salón Comunitario en Guadua",
        "ubicacion" => "Vereda El Mirador, Nariño",
        "categoria" => "Infraestructura Comunitaria",
        "presupuesto" => 95000000,
        "ejecutado" => 95000000,
        "estado" => "Completada"
    ],
    [
        "nombre" => "Beneficiadero Rural de Café",
        "ubicacion" => "San Lorenzo, Nariño",
        "categoria" => "Infraestructura Agroindustrial",
        "presupuesto" => 64000000,
        "ejecutado" => 19200000,
        "estado" => "Cimentación"
    ]
];

function formatoCOP($valor) {
    return "$" . number_format($valor, 0, ",", ".") . " COP";
}

$totalPresupuesto = 0;
$totalEjecutado = 0;
foreach ($proyectos as $p) {
    $totalPresupuesto += $p["presupuesto"];
    $totalEjecutado += $p["ejecutado"];
}
$saldoGlobal = $totalPresupuesto - $totalEjecutado;
$avanceGlobal = $totalPresupuesto > 0 ? round(($totalEjecutado / $totalPresupuesto) * 100) : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $empresa["nombre"]; ?> | Gestión y Control de Construcción</title>
  <style>
    * { box-sizing: border-box; }
    body { margin: 0; font-family: 'Segoe UI', Arial, sans-serif; color: #1e293b; background: #f8fafc; line-height: 1.6; }
    a { text-decoration: none; }

    /* Barra de navegación */
    header { background: #0f172a; color: #ffffff; position: sticky; top: 0; z-index: 10; box-shadow: 0 2px 8px rgba(0,0,0,0.15); }
    .nav-container { max-width: 1100px; margin: 0 auto; padding: 16px 24px; display: flex; justify-content: space-between; align-items: center; }
    .logo { font-size: 1.4rem; font-weight: 700; color: #ffffff; letter-spacing: 0.5px; }
    .logo span { color: #38bdf8; }
    nav a { color: #cbd5e1; margin-left: 22px; font-size: 0.95rem; font-weight: 500; }
    nav a:hover { color: #38bdf8; }

    /* Portada principal (Hero) */
    .hero { background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%); color: #ffffff; padding: 72px 24px; }
    .hero-content { max-width: 1100px; margin: 0 auto; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 32px; }
    .hero-text { flex: 1 1 520px; }
    .hero-badge { display: inline-block; background: rgba(56, 189, 248, 0.2); color: #7dd3fc; padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; margin-bottom: 16px; }
    .hero h1 { font-size: 2.5rem; line-height: 1.2; margin: 0 0 16px; }
    .hero p { font-size: 1.1rem; color: #e2e8f0; margin: 0 0 28px; }
    .btn { display: inline-block; padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: 0.95rem; }
    .btn-primary { background: #38bdf8; color: #0f172a; margin-right: 12px; }
    .btn-outline { border: 1px solid #94a3b8; color: #ffffff; }

    /* Tarjeta resumen en portada */
    .hero-card { flex: 1 1 320px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.18); border-radius: 14px; padding: 24px; }
    .hero-card h3 { margin-top: 0; font-size: 1.1rem; color: #7dd3fc; }
    .stat-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.12); font-size: 0.95rem; }
    .stat-row:last-child { border-bottom: none; }

    /* Secciones generales */
    section { max-width: 1100px; margin: 0 auto; padding: 60px 24px; }
    .section-title { text-align: center; margin-bottom: 40px; }
    .section-title h2 { font-size: 1.9rem; color: #0f172a; margin: 0 0 8px; }
    .section-title p { color: #64748b; margin: 0; }

    /* Tarjetas de servicios y proyectos */
    .grid-3 { display: grid; grid-template-columns: repeat(auto-fit, minmax(290px, 1fr)); gap: 24px; }
    .card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04); }
    .card h3 { margin-top: 0; color: #0f172a; font-size: 1.2rem; }
    .card p { color: #475569; font-size: 0.95rem; margin-bottom: 0; }

    /* Proyectos */
    .tag { display: inline-block; background: #e0f2fe; color: #0369a1; font-size: 0.8rem; font-weight: 600; padding: 4px 10px; border-radius: 6px; margin-bottom: 10px; }
    .project-meta { margin: 14px 0; font-size: 0.9rem; color: #334155; }
    .project-meta div { margin-bottom: 6px; }
    .progress-bar { width: 100%; height: 10px; background: #e2e8f0; border-radius: 999px; overflow: hidden; margin: 12px 0 6px; }
    .progress-fill { height: 100%; background: #0284c7; }
    .status-pill { display: inline-block; margin-top: 10px; padding: 4px 12px; border-radius: 20px; font-size: 0.82rem; font-weight: 600; background: #dcfce7; color: #166534; }

    /* Pie de página */
    footer { background: #0f172a; color: #94a3b8; padding: 40px 24px; margin-top: 40px; }
    .footer-content { max-width: 1100px; margin: 0 auto; display: flex; flex-wrap: wrap; justify-content: space-between; gap: 24px; font-size: 0.9rem; }
    .footer-content strong { color: #ffffff; display: block; margin-bottom: 8px; font-size: 1.05rem; }
  </style>
</head>
<body>

  <!-- Encabezado y Menú -->
  <header>
    <div class="nav-container">
      <a href="#inicio" class="logo"><?php echo $empresa["nombre"]; ?><span>.</span></a>
      <nav>
        <a href="#inicio">Inicio</a>
        <a href="#servicios">Servicios</a>
        <a href="#proyectos">Proyectos</a>
        <a href="#contacto">Contacto</a>
      </nav>
    </div>
  </header>

  <!-- Portada Principal -->
  <div id="inicio" class="hero">
    <div class="hero-content">
      <div class="hero-text">
        <span class="hero-badge">Plataforma Web de Arquitectura e Ingeniería</span>
        <h1><?php echo $empresa["eslogan"]; ?></h1>
        <p>Supervisa presupuestos, porcentajes de avance físico y saldos disponibles de tus proyectos constructivos desde un solo sitio web dinámico desarrollado en PHP.</p>
        <a href="#proyectos" class="btn btn-primary">Ver proyectos activos</a>
        <a href="#servicios" class="btn btn-outline">Conocer servicios</a>
      </div>

      <div class="hero-card">
        <h3>Balance Consolidado (PHP en vivo)</h3>
        <div class="stat-row">
          <span>Obras registradas:</span>
          <strong><?php echo count($proyectos); ?> proyectos</strong>
        </div>
        <div class="stat-row">
          <span>Presupuesto total:</span>
          <strong><?php echo formatoCOP($totalPresupuesto); ?></strong>
        </div>
        <div class="stat-row">
          <span>Total ejecutado:</span>
          <strong><?php echo formatoCOP($totalEjecutado); ?></strong>
        </div>
        <div class="stat-row">
          <span>Saldo disponible:</span>
          <strong><?php echo formatoCOP($saldoGlobal); ?></strong>
        </div>
        <div class="stat-row">
          <span>Avance general:</span>
          <strong><?php echo $avanceGlobal; ?>%</strong>
        </div>
      </div>
    </div>
  </div>

  <!-- Sección de Servicios -->
  <section id="servicios">
    <div class="section-title">
      <h2>Nuestros Servicios</h2>
      <p>Soluciones digitales diseñadas para el seguimiento técnico y financiero en obra</p>
    </div>
    <div class="grid-3">
      <?php foreach ($servicios as $servicio): ?>
        <div class="card">
          <h3><?php echo htmlspecialchars($servicio["titulo"]); ?></h3>
          <p><?php echo htmlspecialchars($servicio["descripcion"]); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Sección de Proyectos -->
  <section id="proyectos" style="padding-top: 10px;">
    <div class="section-title">
      <h2>Proyectos en Seguimiento</h2>
      <p>Portafolio de obras calculado dinámicamente mediante PHP</p>
    </div>
    <div class="grid-3">
      <?php foreach ($proyectos as $obra): ?>
        <?php
          $porcentaje = $obra["presupuesto"] > 0 ? round(($obra["ejecutado"] / $obra["presupuesto"]) * 100) : 0;
          $saldo = $obra["presupuesto"] - $obra["ejecutado"];
        ?>
        <div class="card">
          <span class="tag"><?php echo htmlspecialchars($obra["categoria"]); ?></span>
          <h3><?php echo htmlspecialchars($obra["nombre"]); ?></h3>
          <p><strong>Ubicación:</strong> <?php echo htmlspecialchars($obra["ubicacion"]); ?></p>
          <div class="project-meta">
            <div><strong>Presupuesto:</strong> <?php echo formatoCOP($obra["presupuesto"]); ?></div>
            <div><strong>Ejecutado:</strong> <?php echo formatoCOP($obra["ejecutado"]); ?></div>
            <div><strong>Saldo:</strong> <?php echo formatoCOP($saldo); ?></div>
          </div>
          <div class="progress-bar">
            <div class="progress-fill" style="width: <?php echo $porcentaje; ?>%;"></div>
          </div>
          <small>Avance físico: <strong><?php echo $porcentaje; ?>%</strong></small><br>
          <span class="status-pill"><?php echo htmlspecialchars($obra["estado"]); ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Pie de página -->
  <footer id="contacto">
    <div class="footer-content">
      <div>
        <strong><?php echo $empresa["nombre"]; ?></strong>
        <span><?php echo $empresa["eslogan"]; ?></span>
      </div>
      <div>
        <strong>Contacto</strong>
        <span><?php echo $empresa["ciudad"]; ?></span><br>
        <span><?php echo $empresa["correo"]; ?> · <?php echo $empresa["telefono"]; ?></span>
      </div>
      <div>
        <strong>Información del Sistema</strong>
        <span>Generado con PHP <?php echo phpversion(); ?> · <?php echo date("d/m/Y"); ?></span>
      </div>
    </div>
  </footer>

</body>
</html>