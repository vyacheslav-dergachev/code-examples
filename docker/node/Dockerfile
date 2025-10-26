FROM node:18.17.1

ENV YARN_VERSION 3.8.6

ARG USER_ID=1000
ARG USER_NAME=www-user
ARG GROUP_ID=1000
ARG GROUP_NAME=www-user

###
### Installing the Yarn
###
RUN corepack enable && \
    yarn set version ${YARN_VERSION} && \
    yarn -v

###
### Adding a system user for an application
###
RUN groupmod -g ${GROUP_ID} node &&  \
    usermod -u ${USER_ID} -g ${GROUP_ID} node && \
    usermod -l ${USER_NAME} node && \
    groupmod -n ${GROUP_NAME} node

USER ${USER_NAME}

VOLUME ["/var/www/project"]

WORKDIR /var/www/project

CMD yarn && yarn dev

EXPOSE 3000
