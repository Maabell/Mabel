<html>
<head>
  <title>Validación de Formularios</title>
  <script type="text/javascript">
    // la Validación del Formulario irá aquí
  </script>
</head>
<body>
  <form id="formulario">
    <table cellspacing="2" cellpadding="2" border="1">
      <tr>
        <td align="right">Nombre de Usuario</td>
        <td><input type="text" id="usuario" required /></td>
      </tr>
      <tr>
        <td align="right">Email</td>
        <td><input type="email" id="email" required/></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" value="Submit" id="btn-enviar" /></td>
      </tr>
    </table>
  </form>
</body>
<script src="js/jquery.js"></script>
</html>