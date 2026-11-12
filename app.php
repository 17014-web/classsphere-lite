<?php
// ClassSphere Lite: lightweight learning-space prototype.
$page = isset($_GET['page']) && is_string($_GET['page']) ? $_GET['page'] : 'dashboard';
$allowedPages = ['dashboard', 'lesson'];
if (!in_array($page, $allowedPages, true)) {
    http_response_code(404);
    $page = 'dashboard';
}
function e(string $value): string { return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
$currentPage = $page;
$lessonTitle = 'Introduction to Biology';
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#f4f6ff">
  <meta name="description" content="A simple, low-bandwidth learning space for schools.">
  <title><?= $currentPage === 'lesson' ? e($lessonTitle) : 'Learning space' ?> · ClassSphere Lite</title>
  <link rel="stylesheet" href="assets/style.css">
  <script src="assets/app.js" defer></script>
</head>
<body>
  <a class="skip-link" href="#main">Skip to content</a>
  <div class="app-shell">
    <header class="topbar">
      <a class="brand" href="app.php" aria-label="ClassSphere Lite home">
        <span class="brand-mark" aria-hidden="true">C</span><span>ClassSphere <span class="brand-lite">Lite</span></span>
      </a>
      <div class="topbar-right">
        <span class="network-pill" id="network-status" role="status" aria-live="polite"><span class="status-dot"></span><span>Checking connection…</span></span>
        <button class="icon-button menu-toggle" type="button" aria-label="Open navigation" aria-expanded="false" aria-controls="sidebar">☰</button>
        <div class="avatar" aria-label="Guest profile">G</div>
      </div>
    </header>

    <div class="app-layout">
      <aside class="sidebar" id="sidebar" aria-label="Main navigation">
        <div class="sidebar-label">LEARNING SPACE</div>
        <nav class="nav-list">
          <a class="nav-link <?= $currentPage === 'dashboard' ? 'active' : '' ?>" href="app.php" <?= $currentPage === 'dashboard' ? 'aria-current="page"' : '' ?>><span class="nav-icon" aria-hidden="true">⌂</span><span>Overview</span></a>
          <a class="nav-link <?= $currentPage === 'lesson' ? 'active' : '' ?>" href="app.php?page=lesson" <?= $currentPage === 'lesson' ? 'aria-current="page"' : '' ?>><span class="nav-icon" aria-hidden="true">▤</span><span>Lessons</span></a>
          <a class="nav-link" href="#resources"><span class="nav-icon" aria-hidden="true">▧</span><span>Resources</span></a>
        </nav>
        <div class="sidebar-note"><span class="note-icon" aria-hidden="true">◉</span><strong>Made for steady learning</strong><p>Lightweight pages that keep the focus on your lesson.</p></div>
        <div class="sidebar-foot">CLASSROOM · LEARNING</div>
      </aside>

      <main class="main-content" id="main">
        <?php if ($currentPage === 'lesson'): ?>
          <div class="breadcrumbs"><a href="app.php">Overview</a><span aria-hidden="true">/</span><span>Lesson</span></div>
          <section class="page-heading">
            <div><p class="eyebrow">SCIENCE · 15 MIN</p><h1><?= e($lessonTitle) ?></h1><p class="heading-copy">Explore the building blocks of life in this short introduction.</p></div>
            <span class="lesson-tag"><span class="tag-dot"></span> Lesson</span>
          </section>
          <div class="lesson-layout">
            <article class="panel lesson-panel">
              <div class="lesson-banner"><span class="banner-symbol" aria-hidden="true">✳</span><div><span class="eyebrow light">TODAY'S LEARNING</span><h2>What makes something alive?</h2></div></div>
              <div class="lesson-body">
                <p>Biology is the study of living things. From tiny microorganisms to the largest animals, living things share a set of important characteristics.</p>
                <h3>Living things generally:</h3>
                <ul class="learning-list"><li><span>01</span><div><strong>Are made of cells</strong><p>Cells are the smallest basic units of life.</p></div></li><li><span>02</span><div><strong>Use energy</strong><p>Living things need energy to grow and carry out life processes.</p></div></li><li><span>03</span><div><strong>Grow and respond</strong><p>They change over time and respond to their surroundings.</p></div></li></ul>
                <div class="callout"><strong>Think about it</strong><p>Can you name one living thing and describe how it uses energy?</p></div>
                <label class="field-label" for="lesson-notes">My lesson notes <span>Saved on this device</span></label>
                <textarea id="lesson-notes" class="notes-input" rows="4" placeholder="Write a thought or answer here…" maxlength="4000"></textarea>
                <div class="notes-meta"><span id="notes-status" aria-live="polite">Notes are stored in this browser.</span><span><b id="notes-count">0</b>/4000</span></div>
                <div class="lesson-actions"><a class="button button-secondary" href="app.php">Back to overview</a><button class="button button-primary" type="button" id="complete-lesson">Mark lesson complete <span aria-hidden="true">→</span></button></div>
              </div>
            </article>
            <aside class="panel lesson-side"><span class="side-icon" aria-hidden="true">◷</span><h2>Your progress</h2><p>Take this lesson at your own pace. Your completion is saved on this device.</p><div class="progress-track"><span id="lesson-progress-bar"></span></div><div class="progress-label"><span>Lesson status</span><strong id="lesson-progress-text">Not started</strong></div><div class="side-divider"></div><p class="small-muted">Connection-aware tip</p><p class="tip-copy">This lesson uses text instead of streaming video to help keep data use low.</p></aside>
          </div>
        <?php else: ?>
          <section class="welcome panel">
            <div class="welcome-copy"><p class="eyebrow light">YOUR LEARNING SPACE</p><h1>Small steps.<br>Bright futures.</h1><p>A calm place to continue learning, even when your connection isn't perfect.</p><a class="button button-white" href="app.php?page=lesson">Continue learning <span aria-hidden="true">→</span></a></div>
            <div class="welcome-art" aria-hidden="true"><div class="orbit orbit-one"></div><div class="orbit orbit-two"></div><div class="book-illustration"><span>✦</span><div></div></div></div>
            <span class="welcome-glow" aria-hidden="true"></span>
          </section>
          <section class="section-block" aria-labelledby="progress-title">
            <div class="section-heading"><div><p class="eyebrow">A LITTLE PROGRESS GOES A LONG WAY</p><h2 id="progress-title">Your activity</h2></div><span class="local-label"><span class="tag-dot"></span> Saved on this device</span></div>
            <div class="stats-grid"><article class="panel stat-card"><span class="stat-icon indigo" aria-hidden="true">▤</span><div><p>Lessons completed</p><strong id="completed-count">0</strong><span class="stat-caption">Keep building your streak</span></div></article><article class="panel stat-card"><span class="stat-icon mint" aria-hidden="true">◷</span><div><p>Learning time</p><strong>—</strong><span class="stat-caption">Time tracking not enabled</span></div></article><article class="panel stat-card"><span class="stat-icon peach" aria-hidden="true">⌁</span><div><p>Estimated data use</p><strong id="data-estimate">0 KB</strong><span class="stat-caption">Approximate, for this visit</span></div></article></div>
          </section>
          <section class="section-block" id="resources" aria-labelledby="continue-title">
            <div class="section-heading"><div><p class="eyebrow">PICK UP WHERE YOU LEFT OFF</p><h2 id="continue-title">Continue learning</h2></div><a class="text-link" href="app.php?page=lesson">View lesson <span aria-hidden="true">→</span></a></div>
            <a class="panel course-card" href="app.php?page=lesson"><div class="course-art" aria-hidden="true"><span>✳</span></div><div class="course-copy"><div class="course-meta"><span class="subject-pill">SCIENCE</span><span>15 min</span></div><h3>Introduction to Biology</h3><p>Discover cells, energy, and the shared characteristics of living things.</p><div class="course-progress"><span class="progress-track"><span id="dashboard-progress-bar"></span></span><span id="dashboard-progress-text">Not started</span></div></div><span class="course-arrow" aria-hidden="true">↗</span></a>
          </section>
          <section class="offline-banner"><span class="offline-icon" aria-hidden="true">⌁</span><div><strong>Learning that respects your data</strong><p>This starter lesson is text-based. Your notes and completion are saved locally in this browser.</p></div></section>
        <?php endif; ?>
        <footer class="page-footer"><span>ClassSphere Lite</span><span>Simple learning, thoughtfully made.</span></footer>
      </main>
    </div>
  </div>
  <div class="toast" id="app-toast" role="status" aria-live="polite"></div>
</body>
</html>
