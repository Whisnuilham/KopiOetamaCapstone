// import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import "./dark-mode-toggle";
// import "./chart";
import "./sidebar";
import { Tabs } from 'flowbite';
window.Alpine = Alpine;
window.Tabs = Tabs;

Alpine.start();
import TomSelect from 'tom-select';
window.TomSelect = TomSelect;
import ApexCharts from 'apexcharts';
window.ApexCharts = ApexCharts;
