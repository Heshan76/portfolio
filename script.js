document.addEventListener("DOMContentLoaded", () => {
    const projectsContainer = document.getElementById("projects-container");

    fetch("load_projects.php")
        .then(response => response.json())
        .then(data => {
            data.forEach(project => {
                const projectDiv = document.createElement("div");
                projectDiv.classList.add("project");
                projectDiv.innerHTML = `
                    <img src="${project.image_path}" alt="${project.title}">
                    <h3>${project.title}</h3>
                    <p>${project.description}</p>
                `;
                projectsContainer.appendChild(projectDiv);
            });
        })
        .catch(error => console.error("Error loading projects:", error));
});
// Array of project details
const projects = [
    {
        title: "Social Media Platform",
        description: "A social media platform allowing users to post lecture notes, interact with members, and view posts related to faculty. Includes features like user registration, login, dashboard, and commenting.",
        details: "Built with HTML, CSS, PHP, JavaScript, and SQL. This project handles user authentication, post uploads, and likes/dislikes with real-time updates."
    },
    {
        title: "Portfolio Website",
        description: "A personal portfolio website to showcase my skills, projects, and experiences.",
        details: "Features include dynamic content sections, a contact form, and responsive design. Built with HTML, CSS, and JavaScript."
    },
    {
        title: "Network Security Analyzer",
        description: "A tool to analyze network security vulnerabilities and suggest improvements.",
        details: "Uses PHP for backend scripting and MySQL for database management. Includes features like vulnerability scanning and real-time alerts."
    }
];

// Function to display projects
function displayProjects() {
    const container = document.getElementById('projects-container');
    projects.forEach(project => {
        // Create a div for each project
        const projectDiv = document.createElement('div');
        projectDiv.classList.add('project-box');
        
        // Add project title and description
        const title = document.createElement('h3');
        title.textContent = project.title;
        const description = document.createElement('p');
        description.textContent = project.description;

        // Add click event to show more details
        projectDiv.addEventListener('click', () => {
            alert(project.details);
        });

        // Append elements to project box
        projectDiv.appendChild(title);
        projectDiv.appendChild(description);

        // Append project box to container
        container.appendChild(projectDiv);
    });
}

// Call the function to display projects
displayProjects();
