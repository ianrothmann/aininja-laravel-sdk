# Changelog

All notable changes to `aininja-laravel-sdk` will be documented in this file.

## AI Agent System - 2025-08-26

🆕 New Features

AI Agent System

- Added comprehensive AI Agent support with multi-step task automation
- CreateDubAgent: Audio translation and dubbing with subtitle generation
- ImageGeneratorAgent: Advanced image generation with multiple style options (photorealistic, cinematic, surreal, etc.)
- NewsGeneratorAgent: Context-aware news generation with recency filtering
- GenerateFeedbackVideoAgent: Automated feedback video creation for assessments
- AssessmentMatrixAgent: Advanced assessment matrix generation and analysis

Voice Processing

- New VoiceOverProcessor: Convert text to high-quality voice audio
- Enhanced audio processing capabilities

Generation Modes

- Added Quick Mode and Advanced Mode for text and JSON generation
- Without Reasoning option for faster, direct responses
- Enhanced performance and quality control options

🔧 Improvements

Testing Framework

- Comprehensive test coverage for all new agents
- Enhanced test structure with proper isSuccessful() validation patterns
- Improved mock data validation and subtitle structure testing
- Updated test timeouts to 5 seconds for consistency
- Better Carbon date handling in NewsGenerator tests

Code Quality

- Enhanced type safety with proper Carbon class usage
- Improved validation patterns across all processors
- Better error handling and result validation
- Code style improvements and consistent formatting

Developer Experience

- Enhanced documentation and examples
- Better processor structure and organization
- Improved fluent API design for all new components

🐛 Bug Fixes

- Fixed Carbon type compatibility issues
- Resolved mocking behavior during testing
- Fixed styling and code formatting consistency
- Improved caching behavior for agent operations

📦 Breaking Changes

- NewsGeneratorAgent withRecencyFilter() now requires Illuminate\Support\Carbon instead of string
- Enhanced validation requirements for some processors

🏗️ Technical Details

- Added 762+ lines of new agent functionality
- Comprehensive result classes for all new processors
- Enhanced runner system for agent operations
- Improved input validation and transformation


---

## Bug Fixes - Testing - 2025-08-19

Fixed a bug for mocking during testing

## Agent Support - 2025-03-31

Support for agents with long running tasks
