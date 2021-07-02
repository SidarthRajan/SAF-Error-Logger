// Call the dataTables jQuery plugin
$('#errTable').DataTable({
  ajax: {
    url: 'eTables.json',
    dataSrc: "data"
  },
  columns: [
    { data: 'error_date' },
    { data: 'error_time' },
    { data: 'error_type' },
    { data: 'error_spec' },
    { data: 'error_freq' },
    { data: 'error_file' },
    { data: 'error_line' },
  ],
  "pageLength": 10
});