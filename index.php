<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ICTSupport</title>
<link rel="icon" href="ICTSupport.png">
<script src="https://cdn.tailwindcss.com"></script>
<style>
    body { box-sizing: border-box; }
    .resource-card { transition: all 0.3s ease; }
    .resource-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,0.15);}
    .upload-zone { border: 2px dashed #e5e7eb; transition: all 0.3s ease; }
    .upload-zone.dragover { border-color: #3b82f6; background-color: #eff6ff; }
    .tab-content { display: none; }
    .tab-content.active { display: block; }
    .tab-btn.active { background-color: #3b82f6; color: white; }
</style>
</head>
<body>
<!-- Navigation -->
<nav class="bg-white shadow-lg">
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div class="text-3xl mr-3"><img src="ICTSupport.png" style="width:100px;"></div>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-sm text-gray-600">Educational Resources Platform</div>
                <button onclick="showAdminLogin()" class="text-sm bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">Admin Access</button>
            </div>
        </div>
    </div>
</nav>

<!-- Student Portal -->
<div id="studentContent" class="tab-content active">
    <div class="container mx-auto px-6 py-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Welcome to ICTSupport</h2>
            <p class="text-xl text-gray-600 mb-8">Access educational resources, study materials, and learning content</p>
            <div class="max-w-2xl mx-auto mb-8">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Search for resources, subjects, or topics..." class="w-full px-6 py-4 text-lg border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <button onclick="searchResources()" class="absolute right-2 top-2 bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Category Filters -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Browse by Category</h3>
            <div class="flex flex-wrap gap-3">
                <button onclick="filterByCategory('all')" class="category-btn bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">All Resources</button>
                <button onclick="filterByCategory('Yearly Past Paper')" class="category-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-300 transition-colors">Yearly Past Paper</button>
                <button onclick="filterByCategory('Course Books')" class="category-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-300 transition-colors">Course Books</button>
                <button onclick="filterByCategory('Topical Past Paper')" class="category-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-300 transition-colors">Topical Past Paper</button>
                <button onclick="filterByCategory('Notes')" class="category-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-300 transition-colors">Notes</button>
            </div>
        </div>
        
        <!-- Resource Grid -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-semibold text-gray-800">Available Resources</h3>
                <div class="text-gray-600"><span id="resourceCount">0</span> resources available</div>
            </div>
            <div id="resourcesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
            <div id="noResourcesMessage" class="text-center py-16">
                <div class="text-6xl mb-4">📖</div>
                <h3 class="text-xl font-medium text-gray-500 mb-2">No resources available yet</h3>
                <p class="text-gray-400">Check back later for new educational materials</p>
            </div>
        </div>
    </div>
</div>

<!-- Admin Login Modal -->
<div id="adminLoginModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl p-8 max-w-md w-full mx-4">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Admin Login</h3>
        <form id="adminLoginForm" class="space-y-4">
            <div><label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                <input type="text" id="adminUsername" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter admin username"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" id="adminPassword" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter admin password"></div>
            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">Login</button>
                <button type="button" onclick="hideAdminLogin()" class="flex-1 bg-gray-300 text-gray-700 py-3 rounded-lg font-medium hover:bg-gray-400 transition-colors">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Admin Panel -->
<div id="adminPanel" class="hidden">
    <div class="container mx-auto px-6 py-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Admin Panel</h2>
                <p class="text-gray-600">Upload and manage educational resources</p>
            </div>
            <button onclick="logoutAdmin()" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">Logout</button>
        </div>
        
        <!-- Upload Section -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Upload New Resource</h3>
            <form id="uploadForm" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Resource Title</label>
                        <input type="text" id="resourceTitle" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter resource title">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select id="resourceCategory" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Category</option>
                            <option value="Yearly Past Paper">Yearly Past Paper</option>
                            <option value="Course Books">Course Books</option>
                            <option value="Topical Past Paper">Topical Past Paper</option>
                            <option value="Notes">Notes</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Grade Level</label>
                        <select id="gradeLevel" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Grade Level</option>
                            <option value="Elementary">Elementary (K-5)</option>
                            <option value="Middle School">Middle School (6-8)</option>
                            <option value="High School">High School (9-12)</option>
                            <option value="College">College</option>
                            <option value="All Levels">All Levels</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Resource Type</label>
                        <select id="resourceType" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Type</option>
                            <option value="Past Paper">Past Paper</option>
							<option value="Source Files">Source Files</option>
                            <option value="Course Books">Course Books</option>
                            <option value="Notes">Notes</option>
                        </select>
                    </div>
                </div>
                
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Files</label>
                    <div id="uploadZone" class="upload-zone rounded-lg p-8 text-center cursor-pointer">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <h4 class="text-lg font-medium text-gray-700 mb-2">Drop files here or click to browse</h4>
                            <p class="text-gray-500">PDF, DOC, PPT, MP4, images and more</p>
                        </div>
                    </div>
                    <input type="file" id="fileInput" multiple class="hidden" accept="*/*">
                </div>
                
                <div id="selectedFiles" class="mt-4 hidden">
                    <h4 class="font-medium text-gray-700 mb-2">Selected Files:</h4>
                    <div id="filesList" class="space-y-2"></div>
                </div>
                
                <div class="mt-8">
                    <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-green-700 transition-colors">Upload Resource</button>
                </div>
            </form>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Manage Resources</h3>
            <div id="adminResourcesList" class="space-y-4"></div>
        </div>
    </div>
</div>

<!-- Upload Progress Modal -->
<div id="uploadProgressModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl p-8 max-w-md w-full mx-4 flex flex-col items-center">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Uploading Resource…</h3>
        <div class="w-full flex flex-col items-center">
            <div class="w-full h-4 bg-gray-200 rounded mb-4">
                <div id="uploadProgressBar" class="bg-blue-600 h-4 rounded" style="width: 0%;"></div>
            </div>
            <span id="uploadProgressText" class="text-gray-700 font-medium">Starting upload…</span>
        </div>
    </div>
</div>

<script>
let resources = [];
let currentCategory = 'all';
let selectedFiles = [];
let isAdminLoggedIn = false;

// Load resources with safe field access
function loadResources() {
    fetch('resources.php')
        .then(res => res.json())
        .then(list => {
          resources = list.map((f, i) => ({
  id: i+1,
  title: f.title     || f.resourceTitle,
  category: f.category || f.resourceCategory,
  gradeLevel: f.gradeLevel,
  type: f.type || f.resourceType,
  uploadDate: new Date(f.date),
  files: f.files,
  externalLink: f.externalLink
}));
            displayResources();
            if (isAdminLoggedIn) displayAdminResources();
        })
        .catch(err => {
            console.log('Error loading resources:', err);
            resources = [];
            displayResources();
        });
}

// Safe display function that handles missing fields
function displayResources() {
    const filteredResources = currentCategory === 'all'
        ? resources
        : resources.filter(resource => resource.category === currentCategory);

    const resourcesGrid = document.getElementById('resourcesGrid');
    const noResourcesMessage = document.getElementById('noResourcesMessage');
    const resourceCount = document.getElementById('resourceCount');

    resourceCount.textContent = filteredResources.length;

    if (filteredResources.length === 0) {
        resourcesGrid.innerHTML = '';
        noResourcesMessage.style.display = 'block';
        return;
    }
    noResourcesMessage.style.display = 'none';
    resourcesGrid.innerHTML = filteredResources.map(resource => `
        <div class="resource-card bg-white rounded-xl shadow-lg p-6 border border-gray-200">
            <div class="flex items-start justify-between mb-4">
                <div class="text-3xl">${getCategoryIcon(resource.category)}</div>
                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">${resource.category}</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">${resource.title}</h3>
            <div class="mb-2 flex flex-wrap gap-4 text-gray-700 text-sm">
                <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg> ${resource.gradeLevel}</span>
                <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg> ${resource.type}</span>
                <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2z"></path></svg>${resource.uploadDate.toLocaleDateString()}</span>
            </div>
            <div class="border-t pt-4">
                <h4 class="text-sm font-medium text-gray-700 mb-2">Files (${resource.files.length}):</h4>
                <div class="space-y-2">
                    ${resource.files.map(file => `
                        <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                            <div class="flex items-center">
                                <span class="text-lg mr-2">${getFileIcon(file.type)}</span>
                                <span class="text-sm text-gray-700">${file.name}</span>
                            </div>
                            <a href="${file.url}" download class="text-blue-600 hover:text-blue-800 text-sm">Download</a>
                        </div>
                    `).join('')}
                </div>
            </div>
        </div>
    `).join('');
}

// Utility functions
function getCategoryIcon(category) {
    const icons = {'Mathematics': '📄','Science': '📄','English': '📄','History': '📄','Other': '📄'};
    return icons[category] || '📄';
}
function getFileIcon(type) {
    if (type === 'Document' || type === 'Worksheet') return '📄';
    if (type === 'Presentation') return '📄';
    if (type === 'Video') return '📄';
    if (type === 'Image') return '📄';
    return '📁';
}

function filterByCategory(category) {
    currentCategory = category;
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.classList.remove('bg-blue-600', 'text-white');
        btn.classList.add('bg-gray-200', 'text-gray-700');
    });
    event.target.classList.remove('bg-gray-200', 'text-gray-700');
    event.target.classList.add('bg-blue-600', 'text-white');
    displayResources();
}

function searchResources() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    if (!searchTerm) {
        displayResources();
        return;
    }
    const filteredResources = resources.filter(resource => 
        resource.title.toLowerCase().includes(searchTerm) ||
        (resource.description && resource.description.toLowerCase().includes(searchTerm)) ||
        resource.category.toLowerCase().includes(searchTerm)
    );
    displayFilteredResources(filteredResources);
}

function displayFilteredResources(filteredResources) {
    const resourcesGrid = document.getElementById('resourcesGrid');
    const noResourcesMessage = document.getElementById('noResourcesMessage');
    if (filteredResources.length === 0) {
        resourcesGrid.innerHTML = '';
        noResourcesMessage.innerHTML = `
            <div class="text-6xl mb-4">🔍</div>
            <h3 class="text-xl font-medium text-gray-500 mb-2">No results found</h3>
            <p class="text-gray-400">Try searching with different keywords</p>
        `;
        noResourcesMessage.style.display = 'block';
        return;
    }
    noResourcesMessage.style.display = 'none';
    resourcesGrid.innerHTML = filteredResources.map(resource => `
        <div class="resource-card bg-white rounded-xl shadow-lg p-6 border border-gray-200">
            <div class="flex items-start justify-between mb-4">
                <div class="text-3xl">${getCategoryIcon(resource.category)}</div>
                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">${resource.category}</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">${resource.title}</h3>
            <div class="border-t pt-4">
                <h4 class="text-sm font-medium text-gray-700 mb-2">Files (${resource.files.length}):</h4>
                <div class="space-y-2">
                    ${resource.files.map(file => `
                        <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                            <div class="flex items-center">
                                <span class="text-lg mr-2">${getFileIcon(file.type)}</span>
                                <span class="text-sm text-gray-700">${file.name}</span>
                            </div>
                            <a href="${file.url}" download class="text-blue-600 hover:text-blue-800 text-sm">Download</a>
                        </div>
                    `).join('')}
                </div>
            </div>
        </div>
    `).join('');
}

// Admin authentication
function showAdminLogin() {
    document.getElementById('adminLoginModal').classList.remove('hidden');
}
function hideAdminLogin() {
    document.getElementById('adminLoginModal').classList.add('hidden');
    document.getElementById('adminLoginForm').reset();
}
function logoutAdmin() {
    fetch('admin.php?logout=1').then(() => {
        isAdminLoggedIn = false;
        document.getElementById('adminPanel').classList.add('hidden');
        document.getElementById('studentContent').classList.remove('hidden');
        loadResources();
    });
}

document.getElementById('adminLoginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const username = document.getElementById('adminUsername').value;
    const password = document.getElementById('adminPassword').value;
    fetch('admin.php', {
        method: 'POST',
        body: new URLSearchParams({
            username: username,
            password: password
        })
    })
    .then(res => res.text())
    .then(data => {
        if (data === "ok") {
            isAdminLoggedIn = true;
            hideAdminLogin();
            document.getElementById('studentContent').classList.add('hidden');
            document.getElementById('adminPanel').classList.remove('hidden');
            loadResources();
        } else {
            alert('Invalid credentials.');
        }
    });
});


// File upload functionality
const uploadZone = document.getElementById('uploadZone');
const fileInput = document.getElementById('fileInput');
uploadZone.addEventListener('click', () => fileInput.click());
uploadZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadZone.classList.add('dragover');
});
uploadZone.addEventListener('dragleave', () => {
    uploadZone.classList.remove('dragover');
});
uploadZone.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadZone.classList.remove('dragover');
    const files = Array.from(e.dataTransfer.files);
    handleFileSelection(files);
});
fileInput.addEventListener('change', (e) => {
    const files = Array.from(e.target.files);
    handleFileSelection(files);
});

function handleFileSelection(files) {
    selectedFiles = files;
    displaySelectedFiles();
}

function displaySelectedFiles() {
    const selectedFilesDiv = document.getElementById('selectedFiles');
    const filesList = document.getElementById('filesList');
    if (selectedFiles.length === 0) {
        selectedFilesDiv.classList.add('hidden');
        return;
    }
    selectedFilesDiv.classList.remove('hidden');
    filesList.innerHTML = selectedFiles.map((file, index) => `
        <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
            <div class="flex items-center">
                <span class="text-2xl mr-3">${getFileIcon(file.type)}</span>
                <div>
                    <p class="font-medium text-gray-800">${file.name}</p>
                    <p class="text-sm text-gray-500">${formatFileSize(file.size)}</p>
                </div>
            </div>
            <button onclick="removeFile(${index})" class="text-red-500 hover:text-red-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    `).join('');
}

function removeFile(index) {
    selectedFiles.splice(index, 1);
    displaySelectedFiles();
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// FIXED Upload form with correct FormData keys
document.getElementById('uploadForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const title = document.getElementById('resourceTitle').value.trim();
    const category = document.getElementById('resourceCategory').value;
    const gradeLevel = document.getElementById('gradeLevel').value;
    const type = document.getElementById('resourceType').value;

    if (!title || !category || !gradeLevel || !type || selectedFiles.length === 0) {
        alert('Please fill in all required fields and select a file.');
        return;
    }

    document.getElementById('uploadProgressModal').classList.remove('hidden');
    document.getElementById('uploadProgressBar').style.width = "0%";
    document.getElementById('uploadProgressText').textContent = "Starting upload…";

    const formData = new FormData();
    formData.append('resourceTitle', title);
    formData.append('resourceCategory', category);
    formData.append('gradeLevel', gradeLevel);
    formData.append('resourceType', type);
    for(let i=0; i<selectedFiles.length; i++){
  formData.append('files[]', selectedFiles[i]);
}


    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'upload.php', true);

    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            let percent = Math.round((e.loaded / e.total) * 100);
            document.getElementById('uploadProgressBar').style.width = percent + "%";
            document.getElementById('uploadProgressText').textContent = "Uploading: " + percent + "%";
        }
    };

    xhr.onload = function() {
        document.getElementById('uploadProgressModal').classList.add('hidden');
        let data;
        try { data = JSON.parse(xhr.responseText); } catch (e) { data = {}; }
        if (data.success) {
            alert('Resource uploaded successfully!');
            document.getElementById('uploadForm').reset();
            selectedFiles = [];
            displaySelectedFiles();
            loadResources();
        } else {
            alert(data.error || 'Upload error.');
        }
    };

    xhr.onerror = function() {
        document.getElementById('uploadProgressModal').classList.add('hidden');
        alert('Network error. Check your connection.');
    };

    xhr.send(formData);
});

// Admin resource management
function displayAdminResources() {
    const adminResourcesList = document.getElementById('adminResourcesList');
    if (resources.length === 0) {
        adminResourcesList.innerHTML = '<p class="text-gray-500 text-center py-8">No resources uploaded yet.</p>';
        return;
    }
    adminResourcesList.innerHTML = resources.map(resource => `
        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-800">${resource.title}</h4>
                    <p class="text-sm text-gray-600 mt-1">${resource.category} • ${resource.gradeLevel}</p>
                    <p class="text-sm text-gray-500 mt-1">${resource.files.length} file(s) • Uploaded ${resource.uploadDate.toLocaleDateString()}</p>
                </div>
                <button onclick="deleteResource('${resource.files[0].name}')" class="text-red-500 hover:text-red-700 ml-4" title="Delete Resource">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    `).join('');
}

function deleteResource(resourceTitle) {
    if (!confirm("Are you sure you want to delete this resource? This action cannot be undone.")) return;
    fetch('delete.php', {
        method: 'POST',
        body: new URLSearchParams({ file: resourceTitle })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            alert("Resource deleted successfully.");
            loadResources();
        } else {
            alert(data.error || "Failed to delete resource.");
        }
    })
    .catch(() => alert("Network error while deleting resource."));
}

// Search on Enter key
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        searchResources();
    }
});

// Initialize
loadResources();
</script>
</body>
</html>
