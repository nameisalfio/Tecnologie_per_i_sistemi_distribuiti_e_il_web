package com.example.department_employee.controllers;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;

import com.example.department_employee.Repositories.EmployeeRepository;
import com.example.department_employee.Repositories.DepartmentReposity;
import com.example.department_employee.models.Employee;

@Controller
public class EmployeeController {
    
    private final EmployeeRepository repo;
    private final DepartmentReposity departmentRepo;


    public EmployeeController(EmployeeRepository repo, DepartmentReposity departmentRepo) {
        this.repo = repo;
        this.departmentRepo = departmentRepo;
    }

    @GetMapping("/employees")
    String index(Model model){
        model.addAttribute("employees", repo.findAll());
        return "/employees/index";
    }

    @GetMapping("/employees/create")
    String create(Model model){
        model.addAttribute("departments", departmentRepo.findAll());
        return "/employees/create";
    }

    @PostMapping("/employees/store")
    String store(Employee employee){
        repo.save(employee);
        return "redirect:/employees";
    }

    @GetMapping("/employees/show")
    String show(Model model, Long id){
        model.addAttribute("e", repo.findById(id).orElse(null));
        return "/employees/show";
    }

    @GetMapping("/employees/edit")
    String edit(Model model, Long id){
        model.addAttribute("departments", departmentRepo.findAll());
        model.addAttribute("e", repo.findById(id).orElse(null));
        return "/employees/edit";
    }

    @PostMapping("/employees/update")
    String update(Employee employee){
        repo.save(employee);
        return "redirect:/employees";
    }

    @PostMapping("/employees/destroy")
    String destroy(Employee employee){
        repo.deleteById(employee.getId());
        return "redirect:/employees";
    }

    @GetMapping("/employees/increaseSalary")
    String increaseSalary(Integer percentage, Model model, Long id){
        repo.increaseSalary(id, percentage);
        return show(model, id);
    }
}   
