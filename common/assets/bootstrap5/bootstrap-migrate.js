/**
 * Bootstrap 5 Migration Helper
 * This script helps with the transition from Bootstrap 3/4 to Bootstrap 5
 * by providing compatibility for older JavaScript and data attribute patterns.
 */

(function() {
  'use strict';

  // Migration Helper Object
  const BS5MigrationHelper = {
    // Convert data-toggle attributes to data-bs-toggle
    convertDataAttributes: function() {
      const dataAttributes = {
        'toggle': 'bs-toggle',
        'target': 'bs-target',
        'dismiss': 'bs-dismiss',
        'parent': 'bs-parent',
        'ride': 'bs-ride',
        'spy': 'bs-spy',
        'slide': 'bs-slide',
        'slide-to': 'bs-slide-to'
      };
      
      // Find all elements with data-toggle, data-target, etc.
      for (const oldAttr in dataAttributes) {
        const newAttr = dataAttributes[oldAttr];
        const elements = document.querySelectorAll(`[data-${oldAttr}]`);
        
        elements.forEach(function(el) {
          const value = el.getAttribute(`data-${oldAttr}`);
          if (!el.hasAttribute(`data-${newAttr}`)) {
            el.setAttribute(`data-${newAttr}`, value);
          }
        });
      }
    },
    
    // Initialize Bootstrap 5 components that previously were auto-initialized
    initializeComponents: function() {
      // Tooltips now need to be initialized
      if (typeof bootstrap !== 'undefined') {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"], [data-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Popovers also need to be initialized
        const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"], [data-toggle="popover"]'));
        popoverTriggerList.map(function (popoverTriggerEl) {
          return new bootstrap.Popover(popoverTriggerEl);
        });
      }
    },
    
    // Maintain backward compatibility with jQuery event handlers
    handleJQuery: function() {
      if (typeof jQuery !== 'undefined') {
        // Bootstrap 5 doesn't require jQuery, but we'll add compatibility for old code
        
        // Map old jQuery event names to new Bootstrap 5 event names
        const eventMap = {
          'show.bs.modal': 'show.bs.modal',
          'shown.bs.modal': 'shown.bs.modal',
          'hide.bs.modal': 'hide.bs.modal',
          'hidden.bs.modal': 'hidden.bs.modal',
          'show.bs.dropdown': 'show.bs.dropdown',
          'shown.bs.dropdown': 'shown.bs.dropdown',
          'hide.bs.dropdown': 'hide.bs.dropdown',
          'hidden.bs.dropdown': 'hidden.bs.dropdown',
          'show.bs.tab': 'show.bs.tab',
          'shown.bs.tab': 'shown.bs.tab'
        };
        
        // For each event, ensure jQuery triggers work
        for (const oldEvent in eventMap) {
          const newEvent = eventMap[oldEvent];
          
          // Listen for native events and trigger jQuery events
          document.addEventListener(newEvent.replace('.bs.', '.'), function(e) {
            jQuery(e.target).trigger(newEvent, [e.relatedTarget]);
          });
        }
        
        // Maintain backward compatibility with jQuery plugin calls
        jQuery.fn.modal = function(option) {
          return this.each(function() {
            const $this = jQuery(this);
            if (typeof bootstrap !== 'undefined' && typeof bootstrap.Modal !== 'undefined') {
              const data = bootstrap.Modal.getInstance(this) || new bootstrap.Modal(this);
              if (typeof option === 'string') {
                data[option]();
              }
            }
          });
        };
        
        jQuery.fn.dropdown = function(option) {
          return this.each(function() {
            const $this = jQuery(this);
            if (typeof bootstrap !== 'undefined' && typeof bootstrap.Dropdown !== 'undefined') {
              const data = bootstrap.Dropdown.getInstance(this) || new bootstrap.Dropdown(this);
              if (typeof option === 'string') {
                data[option]();
              }
            }
          });
        };
        
        jQuery.fn.tab = function(option) {
          return this.each(function() {
            const $this = jQuery(this);
            if (typeof bootstrap !== 'undefined' && typeof bootstrap.Tab !== 'undefined') {
              const data = bootstrap.Tab.getInstance(this) || new bootstrap.Tab(this);
              if (typeof option === 'string') {
                data[option]();
              }
            }
          });
        };
        
        jQuery.fn.tooltip = function(option) {
          return this.each(function() {
            const $this = jQuery(this);
            if (typeof bootstrap !== 'undefined' && typeof bootstrap.Tooltip !== 'undefined') {
              let data = bootstrap.Tooltip.getInstance(this);
              if (!data) {
                $this.attr('data-bs-toggle', 'tooltip');
                data = new bootstrap.Tooltip(this);
              }
              if (typeof option === 'string') {
                data[option]();
              }
            }
          });
        };
        
        jQuery.fn.popover = function(option) {
          return this.each(function() {
            const $this = jQuery(this);
            if (typeof bootstrap !== 'undefined' && typeof bootstrap.Popover !== 'undefined') {
              let data = bootstrap.Popover.getInstance(this);
              if (!data) {
                $this.attr('data-bs-toggle', 'popover');
                data = new bootstrap.Popover(this);
              }
              if (typeof option === 'string') {
                data[option]();
              }
            }
          });
        };
      }
    },
    
    // Fix AdminLTE specific compatibility issues
    fixAdminLTE: function() {
      // Add .nav-item class to sidebar elements that might be missing it
      document.querySelectorAll('.sidebar .nav-sidebar > li').forEach(function(el) {
        el.classList.add('nav-item');
      });
      
      // Add .nav-link class to links in sidebar
      document.querySelectorAll('.sidebar .nav-sidebar li > a').forEach(function(el) {
        if (!el.classList.contains('nav-link')) {
          el.classList.add('nav-link');
        }
      });
    },
    
    // Run all migration helpers
    init: function() {
      this.convertDataAttributes();
      this.initializeComponents();
      this.handleJQuery();
      this.fixAdminLTE();
      
      // Log the migration helper has run
      console.log('Bootstrap 5 Migration Helper initialized');
    }
  };
  
  // Run the migration helper when the DOM is fully loaded
  document.addEventListener('DOMContentLoaded', function() {
    BS5MigrationHelper.init();
  });
  
  // Handle mobile menu toggles
  document.querySelectorAll('[data-widget="pushmenu"]').forEach(function(element) {
    element.addEventListener('click', function(e) {
      e.preventDefault();
      
      const body = document.body;
      const windowWidth = window.innerWidth;
      
      if (windowWidth > 991.98) {
        // Desktop behavior - toggle sidebar-collapse class
        body.classList.toggle('sidebar-collapse');
        
        // Store the state in localStorage
        const isCollapsed = body.classList.contains('sidebar-collapse');
        localStorage.setItem('sidebar-collapsed', isCollapsed);
      } else {
        // Mobile behavior - toggle sidebar-open class
        body.classList.toggle('sidebar-open');
      }
    });
  });

  // On page load, check if sidebar was collapsed previously
  document.addEventListener('DOMContentLoaded', function() {
    const body = document.body;
    const windowWidth = window.innerWidth;
    
    if (windowWidth > 991.98) {
      const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
      if (isCollapsed) {
        body.classList.add('sidebar-collapse');
      }
    }
    
    // Add layout-fixed class to body for proper fixed layout
    body.classList.add('layout-fixed');
    
    // Add click event to close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
      const windowWidth = window.innerWidth;
      if (windowWidth <= 991.98 && document.body.classList.contains('sidebar-open')) {
        // Check if click is outside the sidebar
        if (!e.target.closest('.main-sidebar') && !e.target.closest('[data-widget="pushmenu"]')) {
          document.body.classList.remove('sidebar-open');
        }
      }
    });
    
    // Add submenu toggle functionality for mobile
    const hasSubmenuItems = document.querySelectorAll('.nav-item.has-treeview');
    hasSubmenuItems.forEach(function(item) {
      const link = item.querySelector('.nav-link');
      if (link) {
        link.addEventListener('click', function(e) {
          if (window.innerWidth <= 991.98) {
            e.preventDefault();
            // Toggle the menu-open class
            item.classList.toggle('menu-open');
            
            // Toggle visibility of submenu
            const submenu = item.querySelector('.nav-treeview');
            if (submenu) {
              if (item.classList.contains('menu-open')) {
                submenu.style.display = 'block';
              } else {
                submenu.style.display = 'none';
              }
            }
          }
        });
      }
    });
    
    // Handle window resize events to fix layout issues
    window.addEventListener('resize', function() {
      const windowWidth = window.innerWidth;
      
      // Reset mobile sidebar when resizing to desktop
      if (windowWidth > 991.98) {
        document.body.classList.remove('sidebar-open');
        
        // Check localStorage for desktop sidebar state
        const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
        if (isCollapsed) {
          document.body.classList.add('sidebar-collapse');
        } else {
          document.body.classList.remove('sidebar-collapse');
        }
      } else {
        // Reset desktop sidebar when resizing to mobile
        document.body.classList.remove('sidebar-collapse');
      }
    });
  });
  
})(); 