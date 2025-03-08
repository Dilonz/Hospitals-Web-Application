// main.js

// Function to validate forms
function validateForm(event) {
	const form = event.target;
	const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
	let isValid = true;

	inputs.forEach((input) => {
    	if (!input.value.trim()) {
        	isValid = false;
        	alert(`Please fill out the ${input.previousElementSibling.innerText} field.`);
        	input.focus();
        	event.preventDefault();
        	return;
    	}
	});

	return isValid;
}

// Attach form validation to all forms
const forms = document.querySelectorAll('form');
forms.forEach((form) => {
	form.addEventListener('submit', validateForm);
});

// Fix navigation issue by allowing normal page redirection
const navLinks = document.querySelectorAll('nav a');
navLinks.forEach((link) => {
	link.addEventListener('click', (event) => {
    	const targetHref = link.getAttribute('href');
    	if (!targetHref.startsWith('#')) {
        	window.location.href = targetHref; // Allow normal navigation
    	} else {
        	event.preventDefault(); // Prevent default only for same-page anchors
        	const targetId = targetHref.substring(1);
        	const targetElement = document.getElementById(targetId);
        	if (targetElement) {
            	window.scrollTo({
                	top: targetElement.offsetTop,
                	behavior: 'smooth',
            	});
        	}
    	}
	});
});

// Smooth scrolling for in-page navigation
const scrollLinks = document.querySelectorAll('a[href^="#"]');
scrollLinks.forEach((link) => {
	link.addEventListener('click', (event) => {
    	event.preventDefault();
    	const targetId = link.getAttribute('href').substring(1);
    	const targetElement = document.getElementById(targetId);
    	if (targetElement) {
        	window.scrollTo({
            	top: targetElement.offsetTop,
            	behavior: 'smooth',
        	});
    	}
	});
});

// Interactive Button Feedback
const buttons = document.querySelectorAll('.btn');
buttons.forEach((button) => {
	button.addEventListener('click', () => {
    	const alertBox = document.createElement('div');
    	alertBox.style.backgroundColor = '#5ba9e6'; // Updated color
    	alertBox.style.color = '#fff';
    	alertBox.style.padding = '10px';
    	alertBox.style.borderRadius = '5px';
    	alertBox.style.position = 'fixed';
    	alertBox.style.bottom = '20px';
    	alertBox.style.right = '20px';
    	alertBox.innerText = 'Action performed successfully!';
    	document.body.appendChild(alertBox);

    	setTimeout(() => {
        	alertBox.remove();
    	}, 3000);
	});

	// Add hover effect for buttons
	button.addEventListener('mouseenter', () => {
    	button.style.backgroundColor = '#5ba9e6'; // Updated color
    	button.style.color = '#fff';
	});
	button.addEventListener('mouseleave', () => {
    	button.style.backgroundColor = ''; // Reset to default
    	button.style.color = ''; // Reset to default
	});
});

// Dynamic Link Highlighting
window.addEventListener('scroll', () => {
	const sections = document.querySelectorAll('section');
	const navLinks = document.querySelectorAll('nav a');

	sections.forEach((section, index) => {
    	const rect = section.getBoundingClientRect();
    	if (rect.top <= 100 && rect.bottom >= 100) {
        	navLinks.forEach((link) => link.classList.remove('active'));
        	navLinks[index].classList.add('active');
        	navLinks[index].style.color = '#5ba9e6'; // Updated color
    	}
	});
});
