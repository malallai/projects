/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.h                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:18:36 by malallai          #+#    #+#             */
/*   Updated: 2018/12/13 15:04:17 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef GET_NEXT_LINE_H
# define GET_NEXT_LINE_H

# include "libft/includes/libft.h"
# include <fcntl.h>

# define BUFF_SIZE 50000

int	get_next_line(const int fd, char **line);

#endif
