gform.addFilter('gform_file_upload_markup', function (html, file, up, strings, imagesUrl) {
  var formId = up.settings.multipart_params.form_id,
    fieldId = up.settings.multipart_params.field_id;
  html = '<strong>' + file.name + "</strong> <img class='gform_delete' "
    + "src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABmJLR0QA/wD/AP+gvaeTAAABKUlEQVRYhe2Uuw4BQRSGPwqJW6KgU4jeA0jEC2h4Ku8hXkFJiCdYURJR0Ot0FM5kx2TZHTu7QvZPTjYzszP/d85cIFMme42AM3Az4gwM0wAIMldxSgNAmUXtf6tciJFLBXrlHZs410dltZn/9Qr8HIBZ0rC2cwDnygD+EmDvcjHbU78Dmlr7Qswn3RZAmavKdgUiNQCAPrAFWhqEqQYwBzpJAMyk76BBmOae/DNPAqAELKT/CLQN842MeUDdFiCqSjyy0yH0zCOZxwEAKANL/O2wylzpJJN6MSBW+IlsTPOwh2gi37W2SFhcgYHMKwI1bb0qULHJoACM8SthY17nec9VJV7dDqcKOnDvbodz81cHLhUIdf08gTFVwd+OZRIAHYEIMtchpkDrDvRKkk0dBvEBAAAAAElFTkSuQmCC' "
    + "onclick='gformDeleteUploadedFile(" + formId + "," + fieldId + ", this);' "
    + "alt='" + strings.delete_file + "' title='" + strings.delete_file + "' />";

  return html;
});
