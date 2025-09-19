/**
 * Code Generator Utility
 * Generates production-ready code from design elements
 */

const fs = require('fs-extra');
const path = require('path');
const { v4: uuidv4 } = require('uuid');

/**
 * Framework templates and configurations
 */
const FRAMEWORKS = {
  react: {
    extension: 'jsx',
    imports: [
      "import React from 'react';",
      "import { useState, useEffect } from 'react';"
    ],
    componentWrapper: (name, content, props = '') => `
const ${name} = (${props}) => {
  ${content}
};

export default ${name};`,
    stateHook: (name, initial) => `const [${name}, set${name.charAt(0).toUpperCase() + name.slice(1)}] = useState(${initial});`,
    eventHandler: (name, params = '', body = '// Handle event') => `const handle${name} = (${params}) => {
  ${body}
};`
  },
  vue: {
    extension: 'vue',
    template: (content, script, style) => `<template>
  ${content}
</template>

<script>
${script}
</script>

<style scoped>
${style}
</style>`
  },
  angular: {
    extension: 'ts',
    component: (name, template, styles) => `import { Component } from '@angular/core';

@Component({
  selector: 'app-${name.toLowerCase()}',
  template: \`${template}\`,
  styles: [\`${styles}\`]
})
export class ${name}Component {
  constructor() { }
}`
  }
};

/**
 * Styling framework configurations
 */
const STYLING_FRAMEWORKS = {
  tailwind: {
    configFile: 'tailwind.config.js',
    dependencies: ['tailwindcss', '@tailwindcss/forms', '@tailwindcss/typography'],
    classMap: {
      backgroundColor: {
        '#ffffff': 'bg-white',
        '#000000': 'bg-black',
        '#f3f4f6': 'bg-gray-100',
        '#e5e7eb': 'bg-gray-200',
        '#3b82f6': 'bg-blue-500',
        '#ef4444': 'bg-red-500',
        '#10b981': 'bg-green-500'
      },
      color: {
        '#ffffff': 'text-white',
        '#000000': 'text-black',
        '#374151': 'text-gray-700',
        '#3b82f6': 'text-blue-500'
      },
      fontSize: {
        '0.75rem': 'text-xs',
        '0.875rem': 'text-sm',
        '1rem': 'text-base',
        '1.125rem': 'text-lg',
        '1.25rem': 'text-xl',
        '1.5rem': 'text-2xl'
      },
      fontWeight: {
        'normal': 'font-normal',
        'bold': 'font-bold',
        '300': 'font-light',
        '500': 'font-medium',
        '600': 'font-semibold',
        '700': 'font-bold'
      },
      padding: {
        '0.25rem': 'p-1',
        '0.5rem': 'p-2',
        '0.75rem': 'p-3',
        '1rem': 'p-4',
        '1.5rem': 'p-6',
        '2rem': 'p-8'
      },
      margin: {
        '0.25rem': 'm-1',
        '0.5rem': 'm-2',
        '0.75rem': 'm-3',
        '1rem': 'm-4',
        '1.5rem': 'm-6',
        '2rem': 'm-8'
      },
      borderRadius: {
        '0': 'rounded-none',
        '0.25rem': 'rounded',
        '0.375rem': 'rounded-md',
        '0.5rem': 'rounded-lg',
        '0.75rem': 'rounded-xl',
        '9999px': 'rounded-full'
      }
    }
  },
  css: {
    extension: 'css'
  },
  'styled-components': {
    dependencies: ['styled-components'],
    extension: 'js'
  }
};

/**
 * Convert inline styles to framework-specific classes
 */
const convertStyles = (styles, framework = 'tailwind') => {
  if (framework !== 'tailwind') {
    return styles; // Return original styles for non-Tailwind frameworks
  }

  const classes = [];
  const classMap = STYLING_FRAMEWORKS.tailwind.classMap;

  Object.entries(styles).forEach(([property, value]) => {
    if (classMap[property] && classMap[property][value]) {
      classes.push(classMap[property][value]);
    } else {
      // Fallback to arbitrary value syntax
      classes.push(`[${property}:${value}]`);
    }
  });

  return classes.join(' ');
};

/**
 * Generate component code based on element type
 */
const generateElementCode = (element, framework = 'react', styling = 'tailwind') => {
  const { type, content, styles = {}, props = {} } = element;

  switch (type) {
    case 'heading':
      return generateHeading(element, framework, styling);
    case 'paragraph':
      return generateParagraph(element, framework, styling);
    case 'button':
      return generateButton(element, framework, styling);
    case 'input':
      return generateInput(element, framework, styling);
    case 'image':
      return generateImage(element, framework, styling);
    case 'container':
      return generateContainer(element, framework, styling);
    case 'form':
      return generateForm(element, framework, styling);
    case 'navbar':
      return generateNavbar(element, framework, styling);
    case 'card':
      return generateCard(element, framework, styling);
    default:
      return generateGeneric(element, framework, styling);
  }
};

/**
 * Generate heading component
 */
const generateHeading = (element, framework, styling) => {
  const level = element.props?.level || 1;
  const classes = styling === 'tailwind' ? convertStyles(element.styles || {}, styling) : '';
  const content = element.content || 'Heading';

  if (framework === 'react') {
    return `<h${level} className="${classes}">${content}</h${level}>`;
  } else if (framework === 'vue') {
    return `<h${level} class="${classes}">${content}</h${level}>`;
  } else if (framework === 'angular') {
    return `<h${level} class="${classes}">${content}</h${level}>`;
  }
};

/**
 * Generate paragraph component
 */
const generateParagraph = (element, framework, styling) => {
  const classes = styling === 'tailwind' ? convertStyles(element.styles || {}, styling) : '';
  const content = element.content || 'Paragraph text';

  if (framework === 'react') {
    return `<p className="${classes}">${content}</p>`;
  } else {
    return `<p class="${classes}">${content}</p>`;
  }
};

/**
 * Generate button component
 */
const generateButton = (element, framework, styling) => {
  const classes = styling === 'tailwind' ? convertStyles(element.styles || {}, styling) : '';
  const content = element.content || 'Button';
  const onClick = element.props?.onClick || 'handleClick';

  if (framework === 'react') {
    return `<button 
  className="${classes} cursor-pointer transition-colors hover:opacity-80"
  onClick={${onClick}}
>
  ${content}
</button>`;
  } else {
    return `<button class="${classes} cursor-pointer transition-colors hover:opacity-80">${content}</button>`;
  }
};

/**
 * Generate input component
 */
const generateInput = (element, framework, styling) => {
  const classes = styling === 'tailwind' ? convertStyles(element.styles || {}, styling) : '';
  const type = element.props?.type || 'text';
  const placeholder = element.props?.placeholder || '';

  if (framework === 'react') {
    return `<input 
  type="${type}"
  className="${classes} border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
  placeholder="${placeholder}"
/>`;
  } else {
    return `<input type="${type}" class="${classes}" placeholder="${placeholder}">`;
  }
};

/**
 * Generate image component
 */
const generateImage = (element, framework, styling) => {
  const classes = styling === 'tailwind' ? convertStyles(element.styles || {}, styling) : '';
  const src = element.props?.src || 'https://via.placeholder.com/400x300';
  const alt = element.props?.alt || 'Image';

  if (framework === 'react') {
    return `<img 
  src="${src}"
  alt="${alt}"
  className="${classes}"
/>`;
  } else {
    return `<img src="${src}" alt="${alt}" class="${classes}">`;
  }
};

/**
 * Generate container component
 */
const generateContainer = (element, framework, styling) => {
  const classes = styling === 'tailwind' ? convertStyles(element.styles || {}, styling) : '';
  const children = element.children || [];

  const childrenCode = children.map(child => 
    generateElementCode(child, framework, styling)
  ).join('\n  ');

  if (framework === 'react') {
    return `<div className="${classes}">
  ${childrenCode}
</div>`;
  } else {
    return `<div class="${classes}">
  ${childrenCode}
</div>`;
  }
};

/**
 * Generate form component
 */
const generateForm = (element, framework, styling) => {
  const classes = styling === 'tailwind' ? convertStyles(element.styles || {}, styling) : '';
  const fields = element.props?.fields || [];

  const fieldsCode = fields.map(field => {
    const fieldClasses = styling === 'tailwind' 
      ? 'w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent'
      : '';

    return `<div className="mb-4">
  <label className="block text-sm font-medium text-gray-700 mb-2">
    ${field.label}
  </label>
  <input 
    type="${field.type || 'text'}"
    className="${fieldClasses}"
    placeholder="${field.placeholder || ''}"
    ${field.required ? 'required' : ''}
  />
</div>`;
  }).join('\n    ');

  if (framework === 'react') {
    return `<form className="${classes}" onSubmit={handleSubmit}>
  ${fieldsCode}
  <button 
    type="submit"
    className="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors"
  >
    Submit
  </button>
</form>`;
  } else {
    return `<form class="${classes}">
  ${fieldsCode.replace(/className/g, 'class')}
  <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
    Submit
  </button>
</form>`;
  }
};

/**
 * Generate navbar component
 */
const generateNavbar = (element, framework, styling) => {
  const classes = styling === 'tailwind' ? convertStyles(element.styles || {}, styling) : '';
  const brand = element.props?.brand || 'Brand';
  const links = element.props?.links || ['Home', 'About', 'Contact'];

  const linksCode = links.map(link => 
    `<a href="#" className="text-white hover:text-gray-300 transition-colors">${link}</a>`
  ).join('\n      ');

  if (framework === 'react') {
    return `<nav className="${classes}">
  <div className="container mx-auto px-4">
    <div className="flex justify-between items-center">
      <div className="text-xl font-bold text-white">${brand}</div>
      <div className="flex space-x-6">
        ${linksCode}
      </div>
    </div>
  </div>
</nav>`;
  } else {
    return `<nav class="${classes}">
  <div class="container mx-auto px-4">
    <div class="flex justify-between items-center">
      <div class="text-xl font-bold text-white">${brand}</div>
      <div class="flex space-x-6">
        ${linksCode.replace(/className/g, 'class')}
      </div>
    </div>
  </div>
</nav>`;
  }
};

/**
 * Generate card component
 */
const generateCard = (element, framework, styling) => {
  const classes = styling === 'tailwind' ? convertStyles(element.styles || {}, styling) : '';
  const title = element.props?.title || 'Card Title';
  const content = element.content || 'Card content goes here.';

  if (framework === 'react') {
    return `<div className="${classes}">
  <h3 className="text-lg font-semibold mb-2">${title}</h3>
  <p className="text-gray-600">${content}</p>
</div>`;
  } else {
    return `<div class="${classes}">
  <h3 class="text-lg font-semibold mb-2">${title}</h3>
  <p class="text-gray-600">${content}</p>
</div>`;
  }
};

/**
 * Generate generic component
 */
const generateGeneric = (element, framework, styling) => {
  const classes = styling === 'tailwind' ? convertStyles(element.styles || {}, styling) : '';
  const content = element.content || '';
  const tag = element.tag || 'div';

  if (framework === 'react') {
    return `<${tag} className="${classes}">${content}</${tag}>`;
  } else {
    return `<${tag} class="${classes}">${content}</${tag}>`;
  }
};

/**
 * Generate complete component code
 */
const generateCode = async (elements, options = {}) => {
  const {
    framework = 'react',
    styling = 'tailwind',
    typescript = false,
    componentName = 'GeneratedComponent',
    includeImports = true,
    includeExport = true
  } = options;

  let code = '';

  // Add imports
  if (includeImports && framework === 'react') {
    code += "import React from 'react';\n";
    if (typescript) {
      code += "import { FC } from 'react';\n";
    }
    code += "\n";
  }

  // Add component declaration
  if (framework === 'react') {
    const componentDeclaration = typescript 
      ? `const ${componentName}: FC = () => {`
      : `const ${componentName} = () => {`;
    
    code += componentDeclaration + "\n";
    code += "  return (\n";
    code += "    <div className=\"generated-component\">\n";
  }

  // Generate elements
  elements.forEach((element, index) => {
    const elementCode = generateElementCode(element, framework, styling);
    code += "      " + elementCode + "\n";
    if (index < elements.length - 1) {
      code += "\n";
    }
  });

  // Close component
  if (framework === 'react') {
    code += "    </div>\n";
    code += "  );\n";
    code += "};\n";
  }

  // Add export
  if (includeExport && framework === 'react') {
    code += `\nexport default ${componentName};\n`;
  }

  return code;
};

module.exports = {
  generateCode,
  generateElementCode,
  convertStyles,
  FRAMEWORKS,
  STYLING_FRAMEWORKS
};
