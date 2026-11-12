(function () {
  'use strict';
  var NOTES_KEY = 'classsphere-lite-biology-notes-v1';
  var PROGRESS_KEY = 'classsphere-lite-biology-complete-v1';
  var totalBytes = 0;
  var statusEl = document.getElementById('network-status');
  var toastTimer;

  function safeGet(key) { try { return window.localStorage.getItem(key); } catch (error) { return null; } }
  function safeSet(key, value) { try { window.localStorage.setItem(key, value); return true; } catch (error) { return false; } }
  function setText(id, value) { var node = document.getElementById(id); if (node) node.textContent = value; }
  function showToast(message) {
    var toast = document.getElementById('app-toast');
    if (!toast) return;
    toast.textContent = message;
    toast.classList.add('visible');
    window.clearTimeout(toastTimer);
    toastTimer = window.setTimeout(function () { toast.classList.remove('visible'); }, 2800);
  }
  function updateNetwork() {
    if (!statusEl) return;
    var online = navigator.onLine;
    statusEl.classList.toggle('is-offline', !online);
    statusEl.querySelector('span:last-child').textContent = online ? 'Online' : 'Offline';
  }
  function formatBytes(bytes) {
    if (bytes < 1024) return bytes + ' B';
    return (bytes / 1024).toFixed(1) + ' KB';
  }
  function updateDataEstimate() {
    // This counts approximate UTF-8 bytes for resources loaded during this page visit, not network-level transfer.
    if (window.performance && performance.getEntriesByType) {
      var entries = performance.getEntriesByType('resource');
      totalBytes = entries.reduce(function (sum, entry) { return sum + (entry.transferSize || entry.encodedBodySize || 0); }, 0);
    }
    setText('data-estimate', '~' + formatBytes(totalBytes));
  }
  function updateProgress() {
    var done = safeGet(PROGRESS_KEY) === '1';
    var bar = document.getElementById('lesson-progress-bar');
    var dashboardBar = document.getElementById('dashboard-progress-bar');
    var button = document.getElementById('complete-lesson');
    if (bar) bar.style.width = done ? '100%' : '0%';
    if (dashboardBar) dashboardBar.style.width = done ? '100%' : '0%';
    setText('lesson-progress-text', done ? 'Complete' : 'Not started');
    setText('dashboard-progress-text', done ? 'Complete' : 'Not started');
    setText('completed-count', done ? '1' : '0');
    if (button && done) { button.innerHTML = 'Completed <span aria-hidden="true">✓</span>'; button.classList.add('is-complete'); }
  }

  updateNetwork();
  window.addEventListener('online', updateNetwork);
  window.addEventListener('offline', updateNetwork);
  updateDataEstimate();
  window.addEventListener('load', updateDataEstimate);
  updateProgress();

  var menuButton = document.querySelector('.menu-toggle');
  var sidebar = document.getElementById('sidebar');
  if (menuButton && sidebar) {
    menuButton.addEventListener('click', function () {
      var expanded = menuButton.getAttribute('aria-expanded') === 'true';
      menuButton.setAttribute('aria-expanded', String(!expanded));
      menuButton.setAttribute('aria-label', expanded ? 'Open navigation' : 'Close navigation');
      sidebar.classList.toggle('is-open', !expanded);
    });
    sidebar.addEventListener('click', function (event) {
      if (event.target.closest('a')) { sidebar.classList.remove('is-open'); menuButton.setAttribute('aria-expanded', 'false'); menuButton.setAttribute('aria-label', 'Open navigation'); }
    });
  }

  var notes = document.getElementById('lesson-notes');
  var notesStatus = document.getElementById('notes-status');
  if (notes) {
    var saved = safeGet(NOTES_KEY) || '';
    notes.value = saved;
    setText('notes-count', String(saved.length));
    var debounce;
    notes.addEventListener('input', function () {
      setText('notes-count', String(notes.value.length));
      if (notesStatus) notesStatus.textContent = 'Saving…';
      window.clearTimeout(debounce);
      debounce = window.setTimeout(function () {
        var ok = safeSet(NOTES_KEY, notes.value);
        if (notesStatus) notesStatus.textContent = ok ? 'Saved on this device.' : 'Could not save — browser storage is unavailable.';
      }, 250);
    });
  }
  var completeButton = document.getElementById('complete-lesson');
  if (completeButton) {
    completeButton.addEventListener('click', function () {
      if (!safeSet(PROGRESS_KEY, '1')) { showToast('Could not save progress in this browser.'); return; }
      updateProgress();
      showToast('Lesson marked complete on this device.');
    });
  }
})();
